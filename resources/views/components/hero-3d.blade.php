<section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden perspective-1000"
	x-data="{ 
		mouseX: 0, 
		mouseY: 0,
		isMobile: window.matchMedia('(max-width: 768px)').matches,
		canvas: null,
		ctx: null,
		bounds: { width: 0, height: 0 },
		particles: [],
		animationFrame: null,
		handleResize: null,
		pointerMoveHandler: null,
		pointerEnterHandler: null,
		pointerLeaveHandler: null,
		scrollHandler: null,
		laserX: 50,
		laserY: 55,
		hoverIntensity: 0,
		scrollFactor: 0,
		init() {
			if (!this.isMobile) {
				document.addEventListener('mousemove', (e) => {
					this.mouseX = (e.clientX - window.innerWidth / 2) / 40;
					this.mouseY = (e.clientY - window.innerHeight / 2) / 40;
				});
			}
			this.$nextTick(() => this.setupBackground());
		},
		setupBackground() {
			if (!this.$refs?.bgCanvas) { return; }
			this.canvas = this.$refs.bgCanvas;
			this.ctx = this.canvas.getContext('2d', { alpha: true });
			this.handleResize = () => this.resizeCanvas();
			window.addEventListener('resize', this.handleResize);
			this.resizeCanvas();
			this.createParticles();
			this.animateBackground();
			this.attachInteractions();
			this.$el.addEventListener('alpine:destroy', () => {
				if (this.animationFrame) { cancelAnimationFrame(this.animationFrame); }
				if (this.handleResize) { window.removeEventListener('resize', this.handleResize); }
				if (this.pointerMoveHandler) { this.$el.removeEventListener('mousemove', this.pointerMoveHandler); }
				if (this.pointerEnterHandler) { this.$el.removeEventListener('mouseenter', this.pointerEnterHandler); }
				if (this.pointerLeaveHandler) { this.$el.removeEventListener('mouseleave', this.pointerLeaveHandler); }
				if (this.scrollHandler) { window.removeEventListener('scroll', this.scrollHandler); }
			}, { once: true });
		},
		attachInteractions() {
			this.pointerMoveHandler = (event) => this.updateLaserPointer(event);
			this.pointerEnterHandler = () => { this.hoverIntensity = 1; };
			this.pointerLeaveHandler = () => {
				this.hoverIntensity = 0;
				this.laserX = 50;
				this.laserY = 55;
			};
			if (!this.isMobile) {
				this.$el.addEventListener('mousemove', this.pointerMoveHandler);
				this.$el.addEventListener('mouseenter', this.pointerEnterHandler);
				this.$el.addEventListener('mouseleave', this.pointerLeaveHandler);
			}
			this.scrollHandler = () => this.updateScrollFactor();
			window.addEventListener('scroll', this.scrollHandler, { passive: true });
			this.updateScrollFactor();
		},
		resizeCanvas() {
			if (!this.canvas || !this.ctx) { return; }
			const dpr = window.devicePixelRatio || 1;
			const width = this.canvas.offsetWidth;
			const height = this.canvas.offsetHeight;
			if (!width || !height) { return; }
			this.canvas.width = width * dpr;
			this.canvas.height = height * dpr;
			this.ctx.setTransform(1, 0, 0, 1, 0, 0);
			this.ctx.scale(dpr, dpr);
			this.bounds = { width, height };
			if (this.particles.length) {
				this.particles.forEach((p) => {
					p.x = Math.max(0, Math.min(width, p.x));
					p.y = Math.max(0, Math.min(height, p.y));
				});
			}
			if (!this.particles.length) {
				this.createParticles();
			}
		},
		createParticles(count = 70) {
			if (!this.bounds.width || !this.bounds.height) { return; }
			this.particles = Array.from({ length: count }, () => this.spawnParticle());
		},
		spawnParticle() {
			return {
				x: Math.random() * this.bounds.width,
				y: Math.random() * this.bounds.height,
				vx: (Math.random() - 0.5) * 0.35,
				vy: (Math.random() - 0.5) * 0.35,
				radius: 1 + Math.random() * 2,
				opacity: 0.18 + Math.random() * 0.35
			};
		},
		updateParticles() {
			if (!this.bounds.width || !this.bounds.height) { return; }
			const { width, height } = this.bounds;
			this.particles.forEach((p) => {
				p.x += p.vx;
				p.y += p.vy;
				if (p.x <= 0 || p.x >= width) { p.vx *= -1; }
				if (p.y <= 0 || p.y >= height) { p.vy *= -1; }
				if (Math.random() < 0.004) {
					p.vx += (Math.random() - 0.5) * 0.06;
					p.vy += (Math.random() - 0.5) * 0.06;
				}
			});
		},
		drawBackground() {
			if (!this.ctx || !this.bounds.width || !this.bounds.height) { return; }
			const { width, height } = this.bounds;
			this.ctx.clearRect(0, 0, width, height);
			const gradient = this.ctx.createLinearGradient(0, 0, width, height);
			gradient.addColorStop(0, 'rgba(0, 255, 136, 0.08)');
			gradient.addColorStop(1, 'rgba(123, 97, 255, 0.08)');
			this.ctx.fillStyle = gradient;
			this.ctx.fillRect(0, 0, width, height);
			this.particles.forEach((p) => {
				this.ctx.beginPath();
				this.ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
				this.ctx.fillStyle = `rgba(0, 255, 136, ${p.opacity})`;
				this.ctx.fill();
			});
		},
		animateBackground() {
			const loop = () => {
				if (!this.particles.length && this.bounds.width && this.bounds.height) {
					this.createParticles();
				}
				this.updateParticles();
				this.drawBackground();
				this.animationFrame = requestAnimationFrame(loop);
			};
			loop();
		},
		updateLaserPointer(event) {
			const rect = this.$el.getBoundingClientRect();
			if (!rect.width || !rect.height) { return; }
			const x = ((event.clientX - rect.left) / rect.width) * 100;
			const y = ((event.clientY - rect.top) / rect.height) * 100;
			this.laserX = Math.max(0, Math.min(100, x));
			this.laserY = Math.max(0, Math.min(100, y));
		},
		updateScrollFactor() {
			const rect = this.$el.getBoundingClientRect();
			const viewportHeight = window.innerHeight || 1;
			const intersectionTop = Math.max(rect.top, 0);
			const intersectionBottom = Math.min(rect.bottom, viewportHeight);
			const visible = Math.max(0, intersectionBottom - intersectionTop);
			const visibleRatio = rect.height ? visible / rect.height : 0;
			const scrollTop = window.scrollY || window.pageYOffset || 0;
			const globalProgress = Math.min(1, scrollTop / (viewportHeight * 1.2));
			this.scrollFactor = Math.min(1, Math.max(visibleRatio, globalProgress));
			if (this.hoverIntensity <= 0.01) {
				const cycle = (scrollTop % (viewportHeight || 1)) / (viewportHeight || 1);
				this.laserX = 50 + Math.sin(cycle * Math.PI * 2) * 18;
				this.laserY = 55 + Math.cos(cycle * Math.PI * 2) * 12;
			}
		}
	}">

	<!-- Background Layers -->
	<div class="absolute inset-0 overflow-hidden pointer-events-none">
		<div class="absolute inset-0 bg-gradient-to-b from-[#050505] via-[#050a08] to-[#010203]"></div>
		<canvas x-ref="bgCanvas" class="absolute inset-0 w-full h-full opacity-80"></canvas>
		<div class="laser-overlay"
			:style="`--laser-x: ${laserX}%; --laser-y: ${laserY}%; --laser-active: ${(Math.max(hoverIntensity, scrollFactor)).toFixed(2)};`"></div>
		<div class="laser-lines"
			:style="`--laser-active: ${(Math.max(hoverIntensity, scrollFactor)).toFixed(2)};`"></div>
		<div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(0,255,136,0.18),transparent_65%)]"></div>
		<div
			class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.02)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.02)_1px,transparent_1px)] bg-[size:30px_30px] md:bg-[size:50px_50px] mix-blend-soft-light">
		</div>
	</div>

	<div
		class="container mx-auto px-4 sm:px-6 relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center pt-20 lg:pt-0">
		<!-- Text Content -->
		<div class="space-y-6 text-center order-2 lg:order-1 pb-12 lg:pb-0">
			<div
				class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-brand-accent/20 bg-black/50 backdrop-blur-md animate-fade-in-up mx-auto">
				<span class="w-2 h-2 rounded-full bg-brand-accent animate-pulse"></span>
				<span class="text-brand-accent text-xs font-mono tracking-wider font-bold">AVAILABLE FOR WORK</span>
			</div>

			<h1 class="text-6xl sm:text-9xl font-black text-white leading-tight animate-fade-in-up delay-100 drop-shadow-2xl">
				ZINDEV
			</h1>

			<p class="text-xl sm:text-2xl font-bold text-brand-accent tracking-widest uppercase animate-fade-in-up delay-150 mb-4">
				Full Team In One Man
			</p>

			<div
				class="h-8 sm:h-12 overflow-hidden text-lg sm:text-2xl font-mono text-brand-muted animate-fade-in-up delay-200">
				<span x-data="{ 
                    text: '', 
                    textArray: ['Full Stack Developer', 'AI Application Architect', 'UI/UX Designer'], 
                    typeSpeed: 100, 
                    deleteSpeed: 50, 
                    waitSpeed: 2000, 
                    textIndex: 0, 
                    charIndex: 0, 
                    isDeleting: false,
                    type() {
                        const current = this.textIndex % this.textArray.length;
                        const fullTxt = this.textArray[current];

                        if (this.isDeleting) {
                            this.text = fullTxt.substring(0, this.charIndex - 1);
                            this.charIndex--;
                        } else {
                            this.text = fullTxt.substring(0, this.charIndex + 1);
                            this.charIndex++;
                        }

                        let typeSpeed = this.typeSpeed;

                        if (this.isDeleting) {
                            typeSpeed /= 2;
                        }

                        if (!this.isDeleting && this.text === fullTxt) {
                            typeSpeed = this.waitSpeed;
                            this.isDeleting = true;
                        } else if (this.isDeleting && this.text === '') {
                            this.isDeleting = false;
                            this.textIndex++;
                            typeSpeed = 500;
                        }

                        setTimeout(() => this.type(), typeSpeed);
                    }
                }" x-init="type()">
					<span x-text="text"></span><span class="animate-pulse">_</span>
				</span>
			</div>

			<p
				class="text-brand-muted max-w-lg mx-auto text-base sm:text-lg leading-relaxed animate-fade-in-up delay-300">
				Crafting premium digital experiences with <span class="text-brand-accent">Laravel</span>, <span
					class="text-brand-accent">Tailwind</span>, and <span class="text-brand-accent">AI</span>
				intelligence.
			</p>

			<div class="flex flex-wrap gap-4 justify-center pt-4 animate-fade-in-up delay-400">
				<a href="#projects" onclick="document.getElementById('projects').scrollIntoView({behavior: 'smooth'}); return false;"
					class="group relative px-8 py-4 bg-brand-accent/20 border border-brand-accent/40 rounded-xl overflow-hidden hover:bg-brand-accent/30 transition-all duration-300">
					<div
						class="absolute inset-0 bg-gradient-to-r from-transparent via-brand-accent/10 to-transparent translate-x-[-100%] group-hover:animate-shimmer">
					</div>
					<span class="font-bold text-brand-accent tracking-wide">VIEW MY WORK</span>
				</a>
				<a href="#contact" onclick="document.getElementById('contact').scrollIntoView({behavior: 'smooth'}); return false;" class="px-8 py-4 text-brand-text hover:text-brand-accent transition-colors font-medium">
					Contact Me
				</a>
			</div>
		</div>

		<!-- 3D Card Visual -->
		<div class="relative order-1 lg:order-2 flex justify-center perspective-2000 pb-10 lg:pb-0"
			class="animate-float">
			<!-- Floating Container with Mouse Tilt -->
			<div class="relative w-[300px] h-[360px] sm:w-[350px] sm:h-[450px] transform-style-3d transition-transform duration-100 ease-out"
				:style="!isMobile ? `transform: rotateX(${mouseY * -1}deg) rotateY(${mouseX}deg)` : ''">

				<!-- Main Glass Card -->
				<div
					class="absolute inset-0 bg-glass-gradient backdrop-blur-xl border border-glass-border rounded-2xl shadow-2xl transform-style-3d flex flex-col overflow-hidden">
					<!-- Card Header -->
					<div class="h-12 border-b border-glass-border flex items-center px-4 gap-2 bg-brand-secondary/50">
						<div class="w-3 h-3 rounded-full bg-red-500/50"></div>
						<div class="w-3 h-3 rounded-full bg-yellow-500/50"></div>
						<div class="w-3 h-3 rounded-full bg-green-500/50"></div>
						<div class="ml-4 text-xs font-mono text-brand-muted/50">zindev.php</div>
					</div>

					<!-- Code Content -->
					<div class="p-6 font-mono text-sm space-y-4 text-brand-muted/80 transform-style-3d">
						<div class="transform translate-z-10">
							<span class="text-brand-accent">class</span> <span class="text-brand-gold">Developer</span>
							{
						</div>
						<div class="pl-4 transform translate-z-20">
							<span class="text-brand-accent">public</span> $stack = [
						</div>
						<div class="pl-8 space-y-1 transform translate-z-30">
							'backend' => <span class="text-brand-gold">'Laravel'</span>,<br>
							'frontend' => <span class="text-brand-gold">'Tailwind'</span>,<br>
							'mobile' => <span class="text-brand-gold">'Flutter'</span>,<br>
							'ai' => <span class="text-brand-gold">'TensorFlow'</span>
						</div>
						<div class="pl-4 transform translate-z-20">
							];
						</div>
						<div class="pl-4 transform translate-z-20 mt-4">
							<span class="text-brand-accent">public function</span> <span
								class="text-brand-gold">create</span>() {
						</div>
						<div class="pl-8 transform translate-z-30">
							<span class="text-brand-accent">return</span> new <span
								class="text-brand-gold">ProblemSolver</span>();
						</div>
						<div class="pl-4 transform translate-z-20">
							}
						</div>
						<div class="transform translate-z-10">
							}
						</div>
					</div>

					<!-- Floating Elements inside card -->
					<div
						class="absolute -right-10 top-20 w-32 h-32 bg-brand-accent/10 rounded-full blur-xl transform translate-z-[-20px]">
					</div>
				</div>

				<!-- Floating Decor Elements (Parallax) -->
				<div
					class="absolute -top-10 -right-10 bg-brand-secondary/80 backdrop-blur-md p-4 rounded-xl border border-glass-border shadow-xl transform translate-z-40 animate-float delay-200">
					<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1200px-Laravel.svg.png"
						class="w-10 h-10 opacity-80" alt="Laravel">
				</div>

				<div
					class="absolute bottom-20 -left-12 bg-brand-secondary/80 backdrop-blur-md p-4 rounded-xl border border-glass-border shadow-xl transform translate-z-50 animate-float delay-500">
					<div class="text-brand-gold font-bold text-2xl">5+</div>
					<div class="text-[10px] uppercase tracking-wider text-brand-muted">Years Exp</div>
				</div>

			</div>
		</div>
	</div>
</section>