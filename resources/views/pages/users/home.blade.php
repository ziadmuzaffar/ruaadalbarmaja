@extends('layouts.users.template')
{{------------ Title ------------}}
@section('title')
    الرئيسية
@endsection
{{------------ Content ------------}}
@section('content')
    {{------------ Landing ------------}}
    <header class="landing">
        {{------------ Container ------------}}
        <div class="container">
            <h1>مرحبا بكم في اكاديمية رواد البرمجة</h1>
            <p>أكاديمية رواد البرمجة هي أكاديمية تعليمية تقدم كورسات في مجال البرمجة وتطوير البرامج تهدف ألاكاديمية الئ تزويد المشتركين بمعرفة أساسية وعملية في لغات البرمجة المختلفة وتقنيات التطوير الحديثة. تقدم ألاكاديمية شروحات مبسطة ومنظمة لتسهيل فهم المفاهيم وتطبيقها في مشاريع عملي</p>
        </div> {{-- Container --}}
    </header> {{-- Landing --}}
    {{------------ Main ------------}}
    <main>
        {{------------ Features ------------}}
        <section class="features">
            {{------------ Container ------------}}
            <div class="container">
                {{------------ Row ------------}}
                <div class="row">
                    {{------------ Column ------------}}
                    <div class="col-lg-4 col-md-6">
                        {{------------ Feature ------------}}
                        <div class="feature">
                            <i class="fa fa-book fa-fw"></i>
                            <h3>محتوى متنوع</h3>
                            <p>مواضيع مختلفة في مجال البرمجة مثل لغات البرمجة المختلفة، وتطوير تطبيقات الويب والهواتف، وتعلم الذكاء الاصطناعي، وغيرها الكثير</p>
                        </div> {{-- Feature --}}
                    </div> {{-- Column --}}
                    {{------------ Column ------------}}
                    <div class="col-lg-4 col-md-6">
                        {{------------ Feature ------------}}
                        <div class="feature">
                            <i class="fa fa-person-chalkboard fa-fw"></i>
                            <h3>شروحات واضحة</h3>
                            <p>شروحات سهلة الفهم ومبسطة للمفاهيم البرمجية المعقدة، مما يعني أنها مفيدة لكل من المبتدئين والمحترفين على حد سواء</p>
                        </div> {{-- Feature --}}
                    </div> {{-- Column --}}
                    {{------------ Column ------------}}
                    <div class="col-lg-4 col-md-6">
                        {{------------ Feature ------------}}
                        <div class="feature">
                            <i class="fa fa-diagram-project fa-fw"></i>
                            <h3>تمارين ومشاريع عملية</h3>
                            <p>تمارين ومشاريع عملية تساعدك على تطبيق المفاهيم التي تم تعلمها في مشاريع حقيقية، مما يعزز فهمك ومهاراتك العملية</p>
                        </div> {{-- Feature --}}
                    </div> {{-- Column --}}
                    {{------------ Column ------------}}
                    <div class="col-lg-4 col-md-6">
                        {{------------ Feature ------------}}
                        <div class="feature">
                            <i class="fa fa-video fa-fw"></i>
                            <h3>جودة الإنتاج</h3>
                            <p>يتم إنتاج الفيديوهات بجودة عالية، مع وجود شرح صوتي ورسومات توضيحية وشاشة تسجيل لتعزيز فهمك العملي وتجربة المشاهدة</p>
                        </div> {{-- Feature --}}
                    </div> {{-- Column --}}
                    {{------------ Column ------------}}
                    <div class="col-lg-4 col-md-6">
                        {{------------ Feature ------------}}
                        <div class="feature">
                            <i class="fa fa-pen-nib fa-fw"></i>
                            <h3>تحديثات منتظمة</h3>
                            <p>تم تحديث المحتوى بشكل منتظم ليشمل أحدث التقنيات والأدوات في مجال البرمجة، مما يضمن أن تكون على اطلاع دائم بأحدث التطورات في المجال</p>
                        </div> {{-- Feature --}}
                    </div> {{-- Column --}}
                    {{------------ Column ------------}}
                    <div class="col-lg-4 col-md-6">
                        {{------------ Feature ------------}}
                        <div class="feature">
                            <i class="fa fa-pen-nib fa-fw"></i>
                            <h3>دعم المجتمع</h3>
                            <p>دعمًا للمتعلمين من خلال منتديات النقاش أو مجموعات التواصل الاجتماعي، حيث يمكنك الاستفادة من خبرات الآخرين والحصول على المساعدة في حالة الحاجة</p>
                        </div> {{-- Feature --}}
                    </div> {{-- Column --}}
                </div> {{-- Row --}}
            </div> {{-- Container --}}
        </section> {{-- Features --}}
        {{------------ Tracks ------------}}
        <section class="tracks">
            <h2>اخر المسارات التعليمية</h2>
            {{------------ Container ------------}}
            <div class="container">
                {{------------ Row ------------}}
                <div class="row">
                    @foreach (DB::table('tracks')->take(3)->latest('id')->get() as $track)
                        <x-users.tracks :track="$track" />
                    @endforeach
                </div> {{-- Row --}}
            </div> {{-- Container --}}
        </section> {{-- Tracks --}}
        {{------------ Courses ------------}}
        <section class="courses">
            <h2>اخر الدورات التعليمية</h2>
            {{------------ Container ------------}}
            <div class="container">
                {{------------ Row ------------}}
                <div class="row">
                    @foreach (DB::table('courses')->take(3)->latest('id')->get() as $course)
                        <x-users.courses :course="$course" />
                    @endforeach
                </div> {{-- Row --}}
            </div> {{-- Container --}}
        </section> {{-- Courses --}}
        {{------------ Statistics ------------}}
        <section class="statistics">
            <h2>احصائيات الاكاديمية</h2>
            {{------------ Container ------------}}
            <div class="container">
                {{------------ Row ------------}}
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="statistic">
                            <i class="fa fa-chart-gantt fa-fw"></i>
                            <p>اجمالي المسارات</p>
                            <span>{{DB::table('tracks')->count()}}</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="statistic">
                            <i class="fa fa-video fa-fw"></i>
                            <p>اجمالي الدورات</p>
                            <span>{{DB::table('courses')->count()}}</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="statistic">
                            <i class="fa fa-clipboard fa-fw"></i>
                            <p>اجمالي الدروس</p>
                            <span>{{DB::table('lessons')->count()}}</span>
                        </div>
                    </div>
                </div> {{-- Row --}}
            </div> {{-- Container --}}
        </section> {{-- Statistics --}}
    </main> {{-- Main --}}
@endsection