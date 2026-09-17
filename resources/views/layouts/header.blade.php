 <!-- Main Header / Header Two -->
 <header class="main-header header-style-two">

     <!-- Header Top -->
     <div class="header-top">
         <div class="auto-container">
             <div class="inner-container">
                 <div class="d-flex justify-content-between align-items-center flex-wrap">
                     <div class="left-box d-flex align-items-center flex-wrap">
                         <!-- Info List -->
                         <ul class="header-top_list d-flex flex-wrap">
                             @settingAvailable('contact:address')
                                 <li><span class="icon flaticon-maps-and-flags"></span>@setting('contact:address')</li>
                             @endsettingAvailable

                             @settingAvailable('contact:phone')
                                 <li><span class="icon flaticon-call-1"></span><a
                                         href="tel:@setting('contact:phone')">@setting('contact:phone')</a>
                                 @endsettingAvailable

                                 @settingAvailable('contact:email')
                                 <li><span class="icon flaticon-email-3"></span><a
                                         href="mailto:@setting('contact:email')">@setting('contact:email')</a></li>
                             @endsettingAvailable


                         </ul>
                     </div>
                     <div class="right-box d-flex align-items-center flex-wrap">

                         {{-- @php
                             $locals = [
                                 'ar' => [
                                     'label' => __('locales.arabic'),
                                     'flag' => 'eg',
                                 ],
                                 'en' => [
                                     'label' => __('locales.english'),
                                     'flag' => 'gb',
                                 ],
                             ];
                         @endphp --}}
                         <!-- Language DropDown -->
                         {{-- <div class="language-dropdown">
                             <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                                 data-bs-toggle="dropdown" aria-expanded="false">
                                 <span class="flag"><img src="@asset('assets/images/icons/flag.png')" alt="" /></span>
                                 {{ $locals[app()->getLocale()]['label'] }} &nbsp;<span
                                     class="fa-solid fa-angle-down fa-fw"></span>
                             </button>
                             <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                 @foreach ($locals as $key => $language)
                                     <li><a class="dropdown-item"
                                             href="@route('locale', ['locale' => $key])">{{ $language['label'] }}</a>
                                     </li>
                                 @endforeach
                             </ul>
                         </div> --}}


                         <!-- Social Box -->
                         <div class="header-top_socials">
                             @settingAvailable('social:facebook')
                                 <a href="@setting('social:facebook')"><i class="fa-brands fa-facebook-f"></i></a>
                             @endsettingAvailable

                             @settingAvailable('social:twitter')
                                 <a href="@setting('social:twitter')"><i class="fa-brands fa-twitter"></i></a>
                             @endsettingAvailable

                             @settingAvailable('social:youtube')
                                 <a href="@setting('social:youtube')"><i class="fa-brands fa-youtube"></i></a>
                             @endsettingAvailable

                             @settingAvailable('social:instagram')
                                 <a href="@setting('social:instagram')"><i class="fa-brands fa-instagram"></i></a>
                             @endsettingAvailable

                         </div>

                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- Header Lower -->
     <div class="header-lower">
         <div class="auto-container">
             <div class="inner-container">
                 <div class="d-flex justify-content-between align-items-center flex-wrap">

                     <div class="logo-box">
                         <div class="logo"><a href="@route('home')"><img src="@settingAsset('logo:light')"
                                     alt="@setting('site:name')" title="@setting('site:name')"></a></div>
                     </div>

                     <div class="nav-outer d-flex flex-wrap">
                         <!-- Main Menu -->
                         <nav class="main-menu navbar-expand-md">
                             <div class="navbar-header">
                                 <!-- Toggle Button -->
                                 <button class="navbar-toggler" type="button" data-toggle="collapse"
                                     data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                     aria-expanded="false" aria-label="Toggle navigation">
                                     <span class="icon-bar"></span>
                                     <span class="icon-bar"></span>
                                     <span class="icon-bar"></span>
                                 </button>
                             </div>

                             <div class="navbar-collapse scroll-nav collapse clearfix" id="navbarSupportedContent">
                                 <ul class="navigation clearfix">
                                     @foreach ($page->sections ?? [] as $section)
                                         @continue(!($section['is_visible'] ?? true))

                                         <li @class(['current' => $loop->first])">
                                             <a href="#{{ $section['name'] }}">
                                                 @t('sections', 'nav.' . $section['name'])
                                             </a>
                                         </li>
                                     @endforeach
                                 </ul>
                             </div>
                         </nav>
                     </div>

                     <!-- Main Menu End-->
                     <div class="outer-box d-flex align-items-center flex-wrap">

                         @settingAvailable('contact:phone')
                             <!-- Header Phone Box -->
                             <div class="header-phone_box">
                                 <div class="header-phone_icon flaticon-conversation"></div>
                                 <div>
                                     Call anytime
                                     <a href="tel:@setting('contact:phone')">@setting('contact:phone')</a>
                                 </div>
                             </div>
                         @endsettingAvailable
                         <!-- Mobile Navigation Toggler -->
                         <div class="mobile-nav-toggler"><span class="icon flaticon-menu-3"></span></div>

                     </div>

                 </div>
             </div>
         </div>
     </div>
     <!--End Header Lower-->

     <!-- Mobile Menu  -->
     <div class="mobile-menu">
         <div class="menu-backdrop"></div>
         <div class="close-btn"><span class="icon flaticon-cancel-1"></span></div>

         <nav class="menu-box">
             <div class="nav-logo"><a href="index.html"><img src="@settingAsset('logo:light')"
                         alt="@setting('site:name')" title="@setting('site:name')"></a></div>
             <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
             </div>
         </nav>
     </div>
     <!-- End Mobile Menu -->

 </header>
 <!-- End Main Header -->
