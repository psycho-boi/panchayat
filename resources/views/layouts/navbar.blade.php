<div class="site-wrap">
  <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
              <span class="icon-close2 js-menu-toggle"></span>
          </div>
      </div>
      <div class="site-mobile-menu-body"></div>
  </div>

  <div class="py-4 bg-tricolor">
      <div class="container">
          <div class="row align-items-center text-left">
              <div class="col-lg-2 col-md-3 col-sm-3 text-center">
                  <img style="height: 8rem" src="{{asset('assets/images/logo1.png')}}" alt="">
              </div>
              <div class="col-lg-8 col-md-6 col-sm-8 text-center text-md-left" style="">
                  <h1 class="" style="color: black">Village Panchayat Pissurlem</h1>
                  <h4 class="" style="color: rgb(116, 110, 110)">Government of Goa </h4>
              </div>
          </div>
      </div>
      <li class="translate-container">
            <div id="google_translate_element"></div>
            <script type="text/javascript">
            function googleTranslateElementInit() {
                  new google.translate.TranslateElement({
                    pageLanguage: 'en',
                    includedLanguages: 'hi,mr,gom,en',
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                  }, 'google_translate_element');
                }
            </script>
            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
      </li>
  </div>
  <header class="site-navbar py-4 js-sticky-header site-navbar-target bg-dark" role="banner">
      <div class="container">
          <div class="d-flex align-items-center">
              <div class="site-logo">
                  <a href="index.html" class="d-none">
                      <p>VP Pissurlem</p>
                  </a>
              </div>
              <div class="mr-auto">
                  <nav class="site-navigation position-relative text-right" role="navigation">
                      <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                          <li class="active">
                              <a href="/" class="nav-link text-left text-light">Home</a>
                          </li>
                          <li class="has-children">
                              <a href="{{route('about')}}" class="nav-link text-left text-light">About Us</a>
                              {{-- <ul class="dropdown">
                                  <li><a href="{{route('about')}}">History</a></li>
                                  <li><a href="{{route('staff.list')}}">Panchayat staff</a></li>
                              </ul> --}}
                          </li>
                          <li>
                              <a href="{{route('form.list')}}" class="nav-link text-left text-light">Forms</a>
                          </li>
                          <li>
                              <a href="{{route('news.list')}}" class="nav-link text-left text-light">News</a>
                          </li>
                          <li>
                              <a href="{{route('scheme.list')}}" class="nav-link text-left text-light">Schemes</a>
                          </li>
                          <li class="has-children">
                              <a href="" class="nav-link text-left text-light">Activities</a>
                              <ul class="dropdown text-sm-white text-md-white">
                                  <li><a class="" href="{{route('workshop.list')}}">Workshop</a></li>
                                  {{-- <li><a href="{{route('scheme.list')}}">Scheme</a></li> --}}
                                  <li><a href="{{route('event.list')}}">event</a></li>
                              </ul>
                          </li>
                          <li class="active">
                              <a href="{{route('facilities.list')}}" class="nav-link text-left text-light">Facilities</a>
                          </li>
                          <li>
                              <a href="{{route('contact')}}" class="nav-link text-left text-light">Contact us</a>
                          </li>
                          <li>
                              
                          </li>
                      </ul>
                  </nav>
                  <div class="ml-auto">
                    <div class="social-wrap">
                      {{-- <a href="#"><span class="icon-facebook"></span></a>
                      <a href="#"><span class="icon-twitter"></span></a>
                      <a href="#"><span class="icon-linkedin"></span></a> --}}
        
                      <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span
                        class="icon-menu h3"></span></a>
                    </div>
                  </div>
              </div>
          </div>
      </div>
  </header>
</div>