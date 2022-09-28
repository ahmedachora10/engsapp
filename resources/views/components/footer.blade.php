<div class="footer">
    <div class="level-1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="#" class="go-top d-flex justify-content-center align-items-center" data-aos="fade-up">
                        <span class="arrow-container">
                            <div></div>
                        </span>
                    </a>
                    <div class="row p-top-66 p-bottom-55">
                        <div class="col-md-4 order-2 order-md-1 text-center text-md-left">
                            <div data-aos="fade-down-menu" data-aos-offset="-50" class="manasa-logo-footer">
                                @include('svgImages.footer-logo')
                            </div>
                            <p data-aos="fade-down-menu" data-aos-offset="-50" data-aos-delay="200"
                                class="footer-paragraph px-4 px-md-0">
                                {{ viewContent($footer_para, 'paragraph_name', 'footer_para') }}
                            </p>
                            <x-socialicons data-aos="fade-down-menu" />
                        </div>
                        <div class="col-md-8 order-1 order-md-2">
                            <div class="footer-links ml-auto">
                                <ul>
                                    <li data-aos="fade-down-menu" data-aos-offset="-50" data-aos-delay="100">
                                        <span>{{ __('main.quicklinks') }}</span>
                                    </li>
                                    <li data-aos="fade-down-menu" data-aos-offset="-50" data-aos-delay="150"><a
                                            href="{{ route('blog.index') }}">{{ __('main.blog') }}</a></li>
                                    <li data-aos="fade-down-menu" data-aos-offset="-50" data-aos-delay="200"><a
                                            href="{{ route('home') . '#_pricing' }}">{{ __('main.subspricing') }}</a>
                                    </li>
                                    <li data-aos="fade-down-menu" data-aos-offset="-50" data-aos-delay="250"><a
                                            href="{{ route('home') . '#_howwework' }}">{{ __('main.howitwork') }}</a>
                                    </li>
                                    <li data-aos="fade-down-menu" data-aos-offset="-50" data-aos-delay="300"><a
                                            href="{{ route('home') . '#_services' }}">{{ __('main.footermanasaservices') }}</a>
                                    </li>
                                </ul>
                                <ul>
                                    <li data-aos="fade-down-menu" data-aos-offset="-50" data-aos-delay="100">
                                        <span>{{ __('main.services') }}</span>
                                    </li>
                                    <li data-aos="fade-down-menu" data-aos-offset="-50" data-aos-delay="150"><a
                                            href="{{ route('services.project') }}">{{ __('main.startproject') }}</a>
                                    </li>
                                    <li data-aos="fade-down-menu" data-aos-offset="-50" data-aos-delay="200"><a
                                            href="{{ route('services.consult') }}">{{ __('main.consulting') }}</a>
                                    </li>
                                    <li data-aos="fade-down-menu" data-aos-offset="-50" data-aos-delay="250"><a
                                            href="{{ route('services.judge') }}">{{ __('main.judging') }}</a></li>
                                    <li data-aos="fade-down-menu" data-aos-offset="-50" data-aos-delay="300"><a
                                            href="{{ route('services.visit') }}">{{ __('main.projectvisit') }}</a>
                                    </li>
                                    <li data-aos="fade-down-menu" data-aos-offset="-50" data-aos-delay="300"><a
                                            href="{{ route('services.licence') }}">{{ __('main.licence') }}</a>
                                    </li>
                                </ul>
                                <ul>
                                    <li data-aos="fade-down-menu" data-aos-offset="-50" data-aos-delay="100">
                                        <span>{{ __('main.support') }}</span>
                                    </li>
                                    <li data-aos="fade-down-menu" data-aos-offset="-50" data-aos-delay="150"><a
                                            href="{{ route('faqcontent') }}">{{ __('main.faq') }}</a></li>
                                    <li data-aos="fade-down-menu" data-aos-offset="-50" data-aos-delay="200"><a
                                            href="{{ route('terms') }}">{{ __('main.termsconditions') }}</a></li>
                                    <li data-aos="fade-down-menu" data-aos-offset="-50" data-aos-delay="250"><a
                                            href="{{ route('contactus') }}">{{ __('main.contactus') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="level-2 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div
                        class="align-items-center d-flex justify-content-around justify-content-md-between level-2-container">
                        <p data-aos="fade-down-menu" data-aos-anchor=".manasa-logo-footer" class="copyright">
                            {!! __('main.copyright', ['year' => now()->year]) !!}</p>
                        <div class="d-md-block d-none social-links">
                            <x-socialicons data-aos="fade-down-menu" data-aos-anchor=".manasa-logo-footer" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
