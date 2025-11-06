// Use official CSP-friendly Alpine package and coordinate with Livewire v3 using
// the ESM build. We dynamically import Livewire AFTER setting config to prevent
// auto-start and ensure the CSP plugin is attached first.
import './bootstrap';
import csp from '@alpinejs/csp';

// Prevent Livewire from auto-starting (must be set BEFORE importing Livewire ESM)
window.livewireScriptConfig = window.livewireScriptConfig || {};

// Prepare CSP plugin (handle default export shapes across bundlers)
const cspPlugin = typeof csp === 'function' ? csp : (typeof csp?.default === 'function' ? csp.default : null);

// Hint Alpine to defer starting so we can attach the CSP plugin BEFORE any evaluation happens.
// This is picked up by Alpine when it initializes (including when bundled inside Livewire ESM).
window.deferLoadingAlpine = function (alpineInit) {
	// Always register the plugin on alpine:init so it attaches BEFORE Alpine starts
	try {
		if (cspPlugin) {
			document.addEventListener('alpine:init', () => {
				try { window.Alpine?.plugin?.(cspPlugin); } catch (_) {}
			}, { once: true });
		}
	} catch (_) {}
	// Continue Alpine initialization
	alpineInit();
};

// Dynamically import the ESM distribution bundled with the PHP package
// Lightweight helpers to avoid CSP-unsafe eval when Livewire parses directive params
function splitParamsCspSafe(str) {
	const parts = [];
	let buf = '';
	let depth = 0;
	let quote = null;
	for (let i = 0; i < str.length; i++) {
		const ch = str[i];
		if (quote) {
			if (ch === quote && str[i - 1] !== '\\') quote = null;
			buf += ch;
			continue;
		}
		if (ch === '"' || ch === "'") { quote = ch; buf += ch; continue; }
		if (ch === '(' || ch === '[' || ch === '{') { depth++; buf += ch; continue; }
		if (ch === ')' || ch === ']' || ch === '}') { depth = Math.max(0, depth - 1); buf += ch; continue; }
		if (ch === ',' && depth === 0) { parts.push(buf.trim()); buf = ''; continue; }
		buf += ch;
	}
	if (buf.trim().length) parts.push(buf.trim());
	return parts.filter(p => p.length);
}

function coerceParamCspSafe(token, eventCtx) {
	if (token === '$event') return eventCtx;
	if (token === 'true') return true;
	if (token === 'false') return false;
	if (token === 'null') return null;
	if (/^-?\d+(?:\.\d+)?$/.test(token)) return Number(token);
	if ((token.startsWith('"') && token.endsWith('"')) || (token.startsWith("'") && token.endsWith("'"))) {
		return token.slice(1, -1);
	}
	if ((token.startsWith('{') && token.endsWith('}')) || (token.startsWith('[') && token.endsWith(']'))) {
		try { return JSON.parse(token); } catch(_) { /* fallthrough */ }
	}
	// Fallback to raw string to avoid eval
	return token;
}

async function boot() {
	// Load Livewire ESM from vendor to avoid UMD bundle side-effects under CSP
	const { Livewire, Alpine: LivewireAlpine, Directive } = await import(
		/* @vite-ignore */ '../../vendor/livewire/livewire/dist/livewire.esm.js'
	);

	// Lazy-import component initializers to keep main chunk light and CSP-friendly
	const { vlogCard } = await import('./components/vlog.js');
	const { quoteWizard } = await import('./components/quoteWizard.js');
	const { portfolioTabs } = await import('./components/portfolioTabs.js');

	// Override Livewire's directive param parser to avoid using new Function under CSP
	try {
		if (Directive && Directive.prototype) {
			Directive.prototype.parseOutMethodAndParams = function(rawMethod) {
				let method = rawMethod;
				let params = [];
				const match = method.match(/^(.*?)\s*\((.*)\)\s*$/s);
				if (match) {
					method = match[1];
					const rawParams = match[2] || '';
					params = splitParamsCspSafe(rawParams).map(p => coerceParamCspSafe(p, this.eventContext));
				}
				return { method, params };
			};
		}
	} catch (_) {}

	// Install a guaranteed CSP-safe evaluator for Alpine expressions (no eval/Function)
	(function installCspEvaluator(Alpine){
		function isNumberLiteral(s){ return /^-?\d+(?:\.\d+)?$/.test(s); }
		function isStringLiteral(s){ return (s.startsWith('"') && s.endsWith('"')) || (s.startsWith("'") && s.endsWith("'")); }
		function stripQuotes(s){ return s.slice(1, -1); }
		function resolveIdentifier(name, scope){
			if (scope && Object.prototype.hasOwnProperty.call(scope, name)) return scope[name];
			if (typeof window !== 'undefined' && Object.prototype.hasOwnProperty.call(window, name)) return window[name];
			return undefined;
		}
		function evalNoEval(expression, { scope = {}, context = null } = {}){
			let expr = String(expression).trim();
			// Unary not
			if (expr.startsWith('!')) {
				return !evalNoEval(expr.slice(1).trim(), { scope, context });
			}
			// Literals
			if (expr === 'true') return true;
			if (expr === 'false') return false;
			if (expr === 'null') return null;
			if (isNumberLiteral(expr)) return Number(expr);
			if (isStringLiteral(expr)) return stripQuotes(expr);
			// Simple call: name(args...)
			const call = expr.match(/^([A-Za-z_$][\w$]*)\s*\((.*)\)\s*$/s);
			if (call) {
				const name = call[1];
				const raw = call[2] || '';
				const fn = resolveIdentifier(name, scope);
				const args = raw ? splitParamsCspSafe(raw).map(t => coerceParamCspSafe(t, null)) : [];
				if (typeof fn === 'function') return fn.apply(scope ?? context ?? null, args);
				return undefined;
			}
			// Bare identifier: if it resolves to a function (e.g., x-data="vlogCard"), call it with no args
			const id = expr.match(/^([A-Za-z_$][\w$]*)$/);
			if (id) {
				const val = resolveIdentifier(id[1], scope);
				if (typeof val === 'function') {
					try { return val.call(scope ?? context ?? null); } catch { return undefined; }
				}
				return val;
			}
			// Fallback: do not attempt to eval complex JS under CSP, return undefined
			return undefined;
		}
		Alpine.setEvaluator((el, expression) => (setter = () => {}, { scope = {}, params = [], context = null } = {}) => {
			try {
				const value = evalNoEval(expression, { scope, context });
				setter(value);
			} catch { setter(undefined); }
		});
	})(LivewireAlpine);

	// Apply CSP plugin too (if available), but our evaluator above already guarantees CSP-safety
	if (cspPlugin) { try { LivewireAlpine.plugin(cspPlugin); } catch (_) {} }
	window.Alpine = LivewireAlpine;
	// Register Alpine data components so templates can use x-data="vlogCard" / x-data="quoteWizard"
	try {
		LivewireAlpine.data('vlogCard', vlogCard);
		LivewireAlpine.data('quoteWizard', quoteWizard);
		LivewireAlpine.data('portfolioTabs', portfolioTabs);
	} catch (_) {
		// Fallback: still expose on window (not used by CSP templates)
		window.vlogCard = vlogCard;
		window.quoteWizard = quoteWizard;
		window.portfolioTabs = portfolioTabs;
	}

	// Start Livewire which will orchestrate Alpine.start() internally
	Livewire.start();
}

// Wait for DOMContentLoaded to ensure the document is ready before starting
if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', boot, { once: true });
} else {
	boot();
}

// Optional check removed to keep console output clean in production
