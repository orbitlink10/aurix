<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Aurix Brand Studio') }}</title>
        <meta name="description" content="Aurix is a Kenyan branding studio shaping bold identities, packaging, and digital experiences for growing businesses across East Africa.">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700|fraunces:500,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @php
            $heroImages = collect((isset($heroImageUrls) && count($heroImageUrls)) ? $heroImageUrls : ['/images/hero-showcase.svg'])
                ->filter()
                ->values();

            $heroFrames = collect(isset($slides) && $slides->count() ? $slides : [])
                ->map(fn ($slide) => [
                    'image' => $slide->image_url,
                    'label' => $slide->title ?: 'Featured rollout',
                    'headline' => $slide->caption ?: 'Identity, packaging, and digital systems built to travel.',
                    'button_text' => $slide->button_text,
                    'button_url' => $slide->button_url,
                ])
                ->filter(fn (array $frame) => filled($frame['image']))
                ->values();

            if ($heroFrames->isEmpty()) {
                $heroFrames = $heroImages->map(fn (string $image, int $index) => [
                    'image' => $image,
                    'label' => $index === 0 ? 'Aurix Branding Studio' : 'East Africa brand systems',
                    'headline' => $index === 0
                        ? 'Identity, packaging, and digital design that stays coherent under pressure.'
                        : 'Built for launches, refreshes, and rollout moments that need fast alignment.',
                    'button_text' => null,
                    'button_url' => null,
                ])->values();
            }

            $trustMarks = [
                'Ndoto Coffee',
                'Lakeview Labs',
                'Safari Trail Hotels',
                'Kibera Makers',
                'Orbit Health',
            ];

            $deliveryMoments = [
                'Positioning and verbal direction',
                'Identity systems for print and digital',
                'Packaging and launch assets ready for production',
            ];

            $caseStudies = [
                [
                    'meta' => 'Retail / Nairobi',
                    'title' => 'Kifaru Outdoor Gear',
                    'summary' => 'Unified brand system for new stores and ecommerce rollout.',
                    'image' => '/images/work/kifaru.svg',
                    'metrics' => ['+38% repeat buyers', '12 store kits'],
                ],
                [
                    'meta' => 'Fintech / Kisumu',
                    'title' => 'PesaLink Partners',
                    'summary' => 'Brand refresh and app UI for a youth-first wallet.',
                    'image' => '/images/work/pesalink.svg',
                    'metrics' => ['2x sign-ups', '45k new users'],
                ],
                [
                    'meta' => 'Hospitality / Mombasa',
                    'title' => 'Coastal Haven Resorts',
                    'summary' => 'Repositioned luxury boutique stays to international travelers.',
                    'image' => '/images/work/coastal.svg',
                    'metrics' => ['+29% bookings', '7 brand touchpoints'],
                ],
            ];

            $insightItems = [
                [
                    'title' => 'Retail visibility',
                    'copy' => 'Shoppers spend under 6 seconds deciding between competing shelves. Strong contrast still earns the first look.',
                ],
                [
                    'title' => 'Mobile-first trust',
                    'copy' => 'Most first impressions happen on a phone. Consistent interface behavior removes doubt fast.',
                ],
                [
                    'title' => 'Regional storytelling',
                    'copy' => 'Brands that connect to local context tend to earn stronger referral momentum in the first quarter after launch.',
                ],
            ];

            $testimonials = [
                [
                    'quote' => 'Aurix gave us a brand language that fits Nairobi and still feels global. The launch kit saved weeks of internal work.',
                    'author' => 'Amara K., Marketing Lead, Orbit Health',
                ],
                [
                    'quote' => 'The strategy sprint forced our team to tighten the story before we spent money on assets. Launch felt far cleaner after that.',
                    'author' => 'David O., Founder, Lakeview Labs',
                ],
            ];
        @endphp
        <div class="page">
            <header class="site-header">
                <div class="container nav">
                    <a class="brand" href="#top" aria-label="Aurix home" data-cursor="Home" data-magnetic>
                        <img class="brand-mark" src="/images/aurix-mark.svg" alt="" width="28" height="28" aria-hidden="true">
                        <span class="brand-name">Aurix</span>
                    </a>
                    <nav class="nav-links" aria-label="Primary">
                        <a href="#work" data-magnetic>Work</a>
                        <a href="#services" data-magnetic>Services</a>
                        <a href="#process" data-magnetic>Approach</a>
                        <a href="#insights" data-magnetic>Insights</a>
                        <a href="#contact" data-magnetic>Contact</a>
                    </nav>
                    <div class="nav-actions">
                        <a class="btn btn-secondary" href="#contact" data-cursor="Start" data-magnetic>Start a project</a>
                    </div>
                </div>
            </header>

            <main id="top">
                <section
                    class="hero"
                    x-data='{"current":0,"frames":@json($heroFrames->values()->all())}'
                    x-init="if (frames.length > 1) { setInterval(() => { current = (current + 1) % frames.length; }, 4500); }"
                >
                    <div class="hero-media" aria-hidden="true">
                        <template x-for="(frame, index) in frames" :key="`${frame.image}-${index}`">
                            <img
                                class="hero-media-image"
                                :class="{ 'is-active': current === index }"
                                :src="frame.image"
                                alt=""
                                loading="eager"
                            >
                        </template>
                    </div>
                    <div class="hero-scrim" aria-hidden="true"></div>
                    <div class="container hero-content">
                        <div class="hero-copy">
                            <p class="hero-kicker reveal" style="--delay: 0.05s;">Aurix Branding Studio</p>
                            <h1 class="hero-title reveal" style="--delay: 0.15s;">Build a brand that stays sharp from first impression to rollout.</h1>
                            <p class="hero-subtitle reveal" style="--delay: 0.22s;">Strategy-led identity, packaging, and digital design for ambitious teams across East Africa.</p>
                            <p class="hero-lead reveal" style="--delay: 0.3s;">We turn positioning, visuals, and product touchpoints into one system your team can use across launch decks, packaging, campaigns, and product screens.</p>
                            <div class="hero-actions reveal" style="--delay: 0.35s;">
                                <a class="btn" href="#contact" data-cursor="Book" data-magnetic>Book a discovery call</a>
                                <a class="btn btn-ghost" href="#work" data-cursor="View" data-magnetic>See case studies</a>
                            </div>
                        </div>
                        <div class="hero-footer">
                            <div class="hero-spotlight reveal" style="--delay: 0.4s;">
                                <p class="eyebrow">Current rollout</p>
                                <h2 x-text="frames[current] ? frames[current].headline : ''"></h2>
                                <p class="hero-spotlight-copy" x-text="frames[current] ? frames[current].label : ''"></p>
                                <a
                                    class="hero-inline-link"
                                    x-show="frames[current] && frames[current].button_url && frames[current].button_text"
                                    :href="frames[current] ? frames[current].button_url : '#'"
                                    x-text="frames[current] ? frames[current].button_text : ''"
                                ></a>
                                <div class="hero-dots" x-show="frames.length > 1">
                                    <template x-for="(frame, index) in frames" :key="index">
                                        <button type="button" :class="{ 'is-active': current === index }" @click="current = index">
                                            <span class="sr-only" x-text="`Show frame ${index + 1}`"></span>
                                        </button>
                                    </template>
                                </div>
                            <div class="hero-chip hero-chip-top" aria-hidden="true">Strategy • Identity • Packaging • Digital</div>
                            <div class="hero-chip hero-chip-bottom" aria-hidden="true">Brand kits delivered in 6-8 weeks</div>
                            <div class="hero-stats reveal" style="--delay: 0.48s;">
                                <div class="hero-stat">
                                    <h3>80+</h3>
                                    <p>Brand launches across Kenya</p>
                                </div>
                                <div class="hero-stat">
                                    <h3>6 weeks</h3>
                                    <p>Average end-to-end turnaround</p>
                                </div>
                                <div class="hero-stat">
                                    <h3>14</h3>
                                    <p>Sectors served in East Africa</p>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </section>

                @if(isset($workCategories) && $workCategories->count())
                <section class="section section-light design-categories">
                    <div class="container">
                        <div class="design-categories-head">
                            <h2>Range when you need it. Cohesion when it matters.</h2>
                            <a href="#work" class="design-categories-link">View all categories <span aria-hidden="true">↗</span></a>
                        </div>
                        <div class="design-categories-list">
                            @foreach($workCategories as $category)
                                <article class="design-category">
                                    <div class="design-category-image-wrap">
                                        @if($category->image_url)
                                            <img class="design-category-image" src="{{ $category->image_url }}" alt="{{ $category->name }}" loading="lazy">
                                        @else
                                            <div class="design-category-image design-category-image-fallback" aria-hidden="true"></div>
                                        @endif
                                    </div>
                                    <h3>{{ $category->name }}</h3>
                                    <p>{{ $category->item_count }} {{ $category->item_count == 1 ? 'item' : 'items' }}</p>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>
                @endif

                <section class="trust-strip">
                    <div class="container trust-strip-grid">
                        <div class="trust-strip-copy reveal" style="--delay: 0.1s;">
                            <p class="eyebrow">Trusted by growing teams</p>
                            <div class="trusted-grid">
                                @foreach($trustMarks as $mark)
                                    <span>{{ $mark }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="delivery-grid reveal" style="--delay: 0.2s;">
                            @foreach($deliveryMoments as $index => $moment)
                                <article class="delivery-item">
                                    <span>{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                    <p>{{ $moment }}</p>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>

                <section id="services" class="section">
                    <div class="container">
                        <div class="section-head">
                            <div>
                                <p class="eyebrow reveal" style="--delay: 0.1s;">Services</p>
                                <h2 class="section-title reveal" style="--delay: 0.2s;">A full-stack brand team, without the overhead.</h2>
                            </div>
                            <p class="section-lead reveal" style="--delay: 0.3s;">Clear strategy, a tight visual system, and delivery-ready files your team can use immediately - from print to product.</p>
                        </div>
                        <div class="cards-grid">
                            @if(isset($services) && $services->count())
                                @foreach($services as $index => $service)
                                    @php
                                        $descriptionLines = collect(preg_split('/\r\n|\r|\n/', (string) ($service->description ?? '')))
                                            ->map(fn ($line) => trim($line))
                                            ->filter()
                                            ->values();
                                        $lead = $descriptionLines->first() ?? 'Service description coming soon.';
                                        $highlights = $descriptionLines->slice(1, 3);
                                    @endphp
                                    <article class="card reveal" style="--delay: {{ number_format(0.1 + (($index % 4) * 0.1), 1) }}s;">
                                        <img class="card-icon" src="{{ $service->image_url ?? '/images/icons/strategy.svg' }}" alt="{{ $service->name }} icon" loading="lazy">
                                        <h3>{{ $service->name }}</h3>
                                        <p>{{ $lead }}</p>
                                        @if($highlights->count())
                                            <ul class="card-list">
                                                @foreach($highlights as $highlight)
                                                    <li>{{ $highlight }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </article>
                                @endforeach
                            @else
                                <article class="card reveal" style="--delay: 0.1s;">
                                    <img class="card-icon" src="/images/icons/strategy.svg" alt="" aria-hidden="true" loading="lazy">
                                    <h3>Brand strategy</h3>
                                    <p>Positioning, messaging, and differentiation tuned for Kenyan audiences.</p>
                                    <ul class="card-list">
                                        <li>Workshop + research</li>
                                        <li>Messaging &amp; tone</li>
                                        <li>Go-to-market story</li>
                                    </ul>
                                </article>
                                <article class="card reveal" style="--delay: 0.2s;">
                                    <img class="card-icon" src="/images/icons/identity.svg" alt="" aria-hidden="true" loading="lazy">
                                    <h3>Visual identity</h3>
                                    <p>Logo systems, typography, and colors that translate from billboards to apps.</p>
                                    <ul class="card-list">
                                        <li>Logo suite</li>
                                        <li>Typography &amp; palette</li>
                                        <li>Brand guidelines</li>
                                    </ul>
                                </article>
                                <article class="card reveal" style="--delay: 0.3s;">
                                    <img class="card-icon" src="/images/icons/packaging.svg" alt="" aria-hidden="true" loading="lazy">
                                    <h3>Packaging + retail</h3>
                                    <p>Packaging, wayfinding, and in-store brand cues that drive shelf presence.</p>
                                    <ul class="card-list">
                                        <li>Packaging system</li>
                                        <li>Print-ready files</li>
                                        <li>Retail rollout kit</li>
                                    </ul>
                                </article>
                                <article class="card reveal" style="--delay: 0.4s;">
                                    <img class="card-icon" src="/images/icons/digital.svg" alt="" aria-hidden="true" loading="lazy">
                                    <h3>Digital experiences</h3>
                                    <p>Web and product design for experiences that feel seamless on mobile.</p>
                                    <ul class="card-list">
                                        <li>Website UI</li>
                                        <li>Design systems</li>
                                        <li>Handoff + QA</li>
                                    </ul>
                                </article>
                            @endif
                        </div>
                    </div>
                </section>

                <section id="branding" class="section gallery">
                    <div class="container">
                        <div class="section-head">
                            <div>
                                <p class="eyebrow reveal" style="--delay: 0.1s;">Branding assets</p>
                                <h2 class="section-title reveal" style="--delay: 0.2s;">A system you can deploy everywhere.</h2>
                            </div>
                            <p class="section-lead reveal" style="--delay: 0.3s;">We deliver clean files and a consistent visual language - ready for social, packaging, signage, and digital UI.</p>
                        </div>

                        <div class="gallery-grid">
                            <figure class="gallery-item reveal" style="--delay: 0.1s;">
                                <img class="gallery-image" src="/images/brand-kit.svg" alt="Brand kit layout preview" loading="lazy">
                                <figcaption>
                                    <h3>Brand kit</h3>
                                    <p>Guidelines, templates, and usage rules.</p>
                                </figcaption>
                            </figure>
                            <figure class="gallery-item reveal" style="--delay: 0.2s;">
                                <img class="gallery-image" src="/images/packaging.svg" alt="Packaging layout preview" loading="lazy">
                                <figcaption>
                                    <h3>Packaging</h3>
                                    <p>Print-ready systems with shelf impact.</p>
                                </figcaption>
                            </figure>
                            <figure class="gallery-item reveal" style="--delay: 0.3s;">
                                <img class="gallery-image" src="/images/web-ui.svg" alt="Web UI layout preview" loading="lazy">
                                <figcaption>
                                    <h3>Web UI</h3>
                                    <p>Modern interfaces built for mobile.</p>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </section>

                <section id="work" class="section work">
                    <div class="container">
                        <div class="section-head">
                            <div>
                                <p class="eyebrow reveal" style="--delay: 0.1s;">Selected work</p>
                                <h2 class="section-title reveal" style="--delay: 0.2s;">Case studies built on momentum, not vanity.</h2>
                            </div>
                            <p class="section-lead reveal" style="--delay: 0.3s;">We measure success in growth markers like sign-ups, retention, and customer recall.</p>
                        </div>
                        <div class="case-grid">
                            @foreach($caseStudies as $case)
                                <article class="case-card reveal" style="--delay: {{ number_format(0.1 + ($loop->index * 0.08), 2) }}s;">
                                    <div class="case-meta">{{ $case['meta'] }}</div>
                                    <img class="case-thumb" src="{{ $case['image'] }}" alt="" aria-hidden="true" loading="lazy">
                                    <h3>{{ $case['title'] }}</h3>
                                    <p>{{ $case['summary'] }}</p>
                                    <div class="case-metrics">
                                        @foreach($case['metrics'] as $metric)
                                            <span>{{ $metric }}</span>
                                        @endforeach
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>

                <section id="process" class="section process">
                    <div class="container">
                        <div class="section-head">
                            <div>
                                <p class="eyebrow reveal" style="--delay: 0.1s;">Process</p>
                                <h2 class="section-title reveal" style="--delay: 0.2s;">A focused, collaborative path from story to system.</h2>
                            </div>
                            <p class="section-lead reveal" style="--delay: 0.3s;">Clear checkpoints, weekly reviews, and delivery-ready files for your internal team or agency.</p>
                        </div>
                        <ol class="process-grid">
                            <li class="process-step reveal" style="--delay: 0.1s;">
                                <span class="step-num">01</span>
                                <h3>Discover</h3>
                                <p>Market research, stakeholder interviews, and brand audit.</p>
                            </li>
                            <li class="process-step reveal" style="--delay: 0.2s;">
                                <span class="step-num">02</span>
                                <h3>Define</h3>
                                <p>Positioning, voice, and story narrative built for local resonance.</p>
                            </li>
                            <li class="process-step reveal" style="--delay: 0.3s;">
                                <span class="step-num">03</span>
                                <h3>Design</h3>
                                <p>Identity, layouts, and digital components with system thinking.</p>
                            </li>
                            <li class="process-step reveal" style="--delay: 0.4s;">
                                <span class="step-num">04</span>
                                <h3>Deliver</h3>
                                <p>Launch kits, brand guidelines, and rollout support.</p>
                            </li>
                        </ol>
                    </div>
                </section>

                <section id="insights" class="section insights">
                    <div class="container">
                        <div class="section-head">
                            <div>
                                <p class="eyebrow reveal" style="--delay: 0.1s;">Insights</p>
                                <h2 class="section-title reveal" style="--delay: 0.2s;">Signals we track across East Africa.</h2>
                            </div>
                            <p class="section-lead reveal" style="--delay: 0.3s;">We share field notes and data snapshots so your team stays ahead of changing customer expectations.</p>
                        </div>
                        <div class="insights-grid">
                            @foreach($insightItems as $index => $insight)
                                <article class="insight reveal" style="--delay: {{ number_format(0.1 + ($index * 0.08), 2) }}s;">
                                    <h3>{{ $insight['title'] }}</h3>
                                    <p>{{ $insight['copy'] }}</p>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>

                <section class="section testimonials">
                    <div class="container">
                        <div class="section-head">
                            <div>
                                <p class="eyebrow reveal" style="--delay: 0.1s;">Client voices</p>
                                <h2 class="section-title reveal" style="--delay: 0.2s;">Teams stay with us for the partnership, not just the deliverables.</h2>
                            </div>
                            <p class="section-lead reveal" style="--delay: 0.3s;">We work closely with marketing leads, founders, and product teams to make rollouts smooth.</p>
                        </div>
                        <div class="testimonial-grid">
                            @foreach($testimonials as $index => $testimonial)
                                <blockquote class="testimonial reveal" style="--delay: {{ number_format(0.1 + ($index * 0.08), 2) }}s;">
                                    <p>"{{ $testimonial['quote'] }}"</p>
                                    <cite>{{ $testimonial['author'] }}</cite>
                                </blockquote>
                            @endforeach
                        </div>
                    </div>
                </section>

                <section id="contact" class="section contact">
                    <div class="container contact-grid">
                        <div class="contact-copy">
                            <p class="eyebrow reveal" style="--delay: 0.1s;">Start a project</p>
                            <h2 class="section-title reveal" style="--delay: 0.2s;">Bring the brief, the draft, or the messy version.</h2>
                            <p class="section-lead reveal" style="--delay: 0.3s;">We reply within two business days with a clear next step, a likely timeline, and the right scope for the stage you are in.</p>
                            <div class="contact-details reveal" style="--delay: 0.38s;">
                                <p>hello@aurix.co.ke</p>
                                <p>Nairobi, Kenya</p>
                                <p>Remote across East Africa</p>
                            </div>
                        </div>
                        <div class="contact-panel reveal" style="--delay: 0.2s;">
                            <article class="contact-step">
                                <span>01</span>
                                <div>
                                    <h3>Share the goal</h3>
                                    <p>Tell us what is changing, what is blocked, and what needs to ship first.</p>
                                </div>
                            </article>
                            <article class="contact-step">
                                <span>02</span>
                                <div>
                                    <h3>Get the scope</h3>
                                    <p>We send back the most sensible path, not a padded list of deliverables.</p>
                                </div>
                            </article>
                            <article class="contact-step">
                                <span>03</span>
                                <div>
                                    <h3>Start the rollout</h3>
                                    <p>Discovery, design, and delivery begin with one shared direction from day one.</p>
                                </div>
                            </article>
                            <div class="contact-actions">
                                <a class="btn" href="mailto:hello@aurix.co.ke?subject=Project%20brief">Email the brief</a>
                                <a class="btn btn-secondary" href="tel:+254700000000">Call +254 700 000 000</a>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <footer class="site-footer">
                <div class="container footer-grid">
                    <div>
                        <a class="brand" href="#top">
                            <img class="brand-mark" src="/images/aurix-mark.svg" alt="" width="28" height="28" aria-hidden="true">
                            <span class="brand-name">Aurix</span>
                        </a>
                        <p>Brand systems built for Kenyan growth teams and founders.</p>
                    </div>
                    <div>
                        <h4>Studios</h4>
                        <p>Nairobi, Kenya</p>
                        <p>Remote across East Africa</p>
                    </div>
                    <div>
                        <h4>Contact</h4>
                        <p>hello@aurix.co.ke</p>
                        <p>+254 700 000 000</p>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p>{{ now()->year }} Aurix Brand Studio. All rights reserved.</p>
                </div>
            </footer>
        </div>
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    </body>
</html>
