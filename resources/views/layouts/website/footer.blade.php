<footer class="footer-custom">
    <div class="container">
        <div class="row g-4">
            <!-- Column 1: Company Overview -->
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center gap-3 mb-3">
                    @if(!empty($company->logo))
                        <img src="{{ asset('public/storage/' . $company->logo) }}" alt="{{ $company->name }}" style="height: 48px; border-radius: 8px;">
                    @else
                        <div class="brand-icon-box">
                            <i class="bi bi-code-slash"></i>
                        </div>
                    @endif
                    <span class="footer-brand-title">{{ $company->name ?? 'رواد البرمجة' }}</span>
                </div>
                <p class="mb-4 text-light-50">
                    {{ $company->description ?? 'الشركة الرائدة في التميز البرمجي والابتكار الرقمي، نقدم أحدث التقنيات والحلول الذكية لتطوير أعمالك.' }}
                </p>
                <!-- Social Media Buttons -->
                @if(!empty($company->facebook_url) || !empty($company->twitter_url) || !empty($company->linkedin_url) || !empty($company->instagram_url) || !empty($company->tiktok_url))
                    <div class="d-flex align-items-center gap-2">
                        @if(!empty($company->facebook_url))
                            <a href="{{ $company->facebook_url }}" target="_blank" class="social-icon-btn" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        @endif
                        @if(!empty($company->twitter_url))
                            <a href="{{ $company->twitter_url }}" target="_blank" class="social-icon-btn" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                        @endif
                        @if(!empty($company->linkedin_url))
                            <a href="{{ $company->linkedin_url }}" target="_blank" class="social-icon-btn" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                        @endif
                        @if(!empty($company->instagram_url))
                            <a href="{{ $company->instagram_url }}" target="_blank" class="social-icon-btn" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        @endif
                        @if(!empty($company->tiktok_url))
                            <a href="{{ $company->tiktok_url }}" target="_blank" class="social-icon-btn" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Column 2: Quick Links -->
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-heading">روابط سريعة</h5>
                <ul class="footer-links">
                    <li><a href="#hero"><i class="bi bi-chevron-left me-1 small"></i> الرئيسية</a></li>
                    <li><a href="#about"><i class="bi bi-chevron-left me-1 small"></i> من نحن</a></li>
                    <li><a href="#services"><i class="bi bi-chevron-left me-1 small"></i> خدماتنا</a></li>
                    <li><a href="#projects"><i class="bi bi-chevron-left me-1 small"></i> مشاريعنا</a></li>
                    <li><a href="#testimonials"><i class="bi bi-chevron-left me-1 small"></i> آراء العملاء</a></li>
                    <li><a href="#faq"><i class="bi bi-chevron-left me-1 small"></i> الأسئلة الشائعة</a></li>
                </ul>
            </div>

            <!-- Column 3: Our Services -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading">أبرز خدماتنا</h5>
                <ul class="footer-links">
                    @forelse($services->take(5) as $service)
                        <li><a href="#services"><i class="bi bi-chevron-left me-1 small"></i> {{ $service->title }}</a></li>
                    @empty
                        <li><a href="#services"><i class="bi bi-chevron-left me-1 small"></i> تطوير المواقع الإلكترونية</a></li>
                        <li><a href="#services"><i class="bi bi-chevron-left me-1 small"></i> تصميم تطبيقات الهواتف</a></li>
                        <li><a href="#services"><i class="bi bi-chevron-left me-1 small"></i> الأنظمة السحابية وERP</a></li>
                        <li><a href="#services"><i class="bi bi-chevron-left me-1 small"></i> حلول الذكاء الاصطناعي</a></li>
                    @endforelse
                </ul>
            </div>

            <!-- Column 4: Contact Details -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading">معلومات التواصل</h5>
                <ul class="footer-links">
                    @if(!empty($company->address))
                        <li class="d-flex align-items-start gap-2 mb-3">
                            <i class="bi bi-geo-alt-fill text-primary mt-1"></i>
                            <span>{{ $company->address }} {{ $company->city ? ' - ' . $company->city : '' }}</span>
                        </li>
                    @endif
                    @if(!empty($company->email))
                        <li class="d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-envelope-fill text-primary"></i>
                            <a href="mailto:{{ $company->email }}">{{ $company->email }}</a>
                        </li>
                    @endif
                    @if(!empty($company->phone))
                        <li class="d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-telephone-fill text-primary"></i>
                            <a href="tel:{{ $company->phone }}" dir="ltr">{{ $company->phone }}</a>
                        </li>
                    @endif
                    @if(!empty($company->working_hours))
                        <li class="d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-clock-fill text-primary"></i>
                            <span class="text-light-50">{{ $company->working_hours }}</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Copyright Bar -->
        <div class="footer-bottom text-center">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                <p class="mb-0">&copy; {{ date('Y') }} {{ $company->name ?? 'رواد البرمجة' }}. جميع الحقوق محفوظة.</p>
                <div class="d-flex align-items-center gap-3 fs-6">
                    <span>تصميم وتطوير بكل حب <i class="bi bi-heart-fill text-danger ms-1"></i></span>
                </div>
            </div>
        </div>
    </div>
</footer>
