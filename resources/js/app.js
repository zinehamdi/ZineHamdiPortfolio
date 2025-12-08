import './bootstrap';
import { vlogCard } from './components/vlog.js';
import { quoteWizard } from './components/quoteWizard.js';
import { portfolioTabs } from './components/portfolioTabs.js';

console.log('App.js loading...');

function register(Alpine) {
	console.log('Registering Alpine components...');
	try {
		Alpine.data('vlogCard', vlogCard);
		Alpine.data('quoteWizard', quoteWizard);
		Alpine.data('portfolioTabs', portfolioTabs);
		console.log('Components registered successfully.');
	} catch (e) {
		console.error('Error registering Alpine components:', e);
	}
}

// Check if Alpine is already present
if (window.Alpine) {
	register(window.Alpine);
} else {
	document.addEventListener('alpine:init', () => {
		register(window.Alpine);
	});
}

// Fallback: If Livewire is present, hook into its init
document.addEventListener('livewire:init', () => {
	if (window.Alpine) register(window.Alpine);
});
