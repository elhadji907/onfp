<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name', 'ONFP') }}</title>

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/scrolling-nav.css') }}" rel="stylesheet">
    
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

  
  <link href="{{ asset('css/agency.min.css') }}" rel="stylesheet">
  
  <link href="{{ asset('css/myStyle.css') }}" rel="stylesheet">
      
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger align-items-baseline" href="#page-top">
                <strong><span class="pl-1">{{ config('app.name', 'ONFP Office') }}</span></strong>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">MENU
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#services">Services</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#about">A propos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#team">Cibles</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#contact">Contacts</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ url('/demandeurs') }}">Formation</a>
                  </li>
                  @if (Route::has('login'))
                  <li class="nav-item">
                    @auth
        
                    <a class="navbar-brand pl-3" href="{{ url('/home') }}">Mon Compte
                        <img src="{{ asset(Auth::user()->profile->getImage()) }}" class="rounded-circle" width="30px" height="auto"/>
                    </a>
                    
                    @else
                  </li>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('login') }}">CONNEXION</a>
                  </li>
                  <li class="nav-item">
                    @if (Route::has('register'))
                    <a class="nav-link js-scroll-trigger" href="{{ route('register') }}">INSCRIPTION</a>
                    @endif
                    @endauth
                  </li>
                  @endif
                </ul>
            </div>
        </div>
    </nav>

    {{-- <header class="bg-primary text-white">
        <div class="container text-center">
            <h1>Welcome to Scrolling Nav</h1>
            <p class="lead">A landing page template freshly redesigned for Bootstrap 4</p>
        </div>
    </header> --}}

    <!-- Header -->
    <header class="masthead">
      <div class="container">
        <div class="intro-text">
          <div class="intro-lead-in">{{ __('Bienvenue ?? l\'Office national de Formation professionnelle') }}</div>
          <div class="intro-heading text-uppercase">ONFP</div>
        {{--   <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Tell Me More</a> --}}
        <p class="intro-lead-in">{{ __('la r??f??rence de la Formation professionnelle') }}</p>
        </div>
      </div>
    </header>

  <!-- Services -->
  <section class="page-section" id="services">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Services</h2>
         {{--  <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> --}}
        </div>
      </div>
      <div class="row text-center">
        <div class="col-md-6">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">{{ ("Formation") }}</h4>
          <p class="text-muted">{{ ("C???est l???organisation d???actions et d???op??rations de formation au b??n??fice de cibles diversifi??es pouvant ??tre les branches professionnelles,
             les demandeurs d???emploi, les travailleurs, les entreprises, les collectivit??s, les organismes de l?????tat, etc. 
             Ces formations s???inscrivent dans une perspective d???obtention d???une qualification professionnelle au regard des cat??gories professionnelles 
             des conventions collectives de branches professionnelles. Ces formations de type modulaire sont sanctionn??es par des attestations,
              des titres de qualification ou des titres professionnels. L???obtention de ces titres peut se faire par la voie de la Validation des Acquis de l???Exp??rience (VAE).") }}
            </p>
        </div>
        <div class="col-md-6">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">{{ ("Documentation / Edition") }}</h4>
          <p class="text-muted">{{ ("L???ONFP produit et diffuse de la documentation et des supports techniques et p??dagogiques sur la formation professionnelle. 
            Il s???agit de la mise ?? la disposition du public de la documentation avec acc??s libre ou conditionn?? sous format physique ou ??lectronique. 
            Il s???agit ??galement de l?????dition et de la distribution de manuels et supports p??dagogiques destin??s aux apprenants ou hommes de m??tier en exercice.
              L???ONFP offre la possibilit?? ?? des auteurs de faire ??diter leur ouvrage d??s lors que ceux ci traitent des questions li??es ?? la formation professionnelle.") }}
            </p>
        </div>
        <div class="col-md-6">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">{{ ("Construction") }}</h4>
          <p class="text-muted">{{ ("Ce service consiste ?? la maitrise d???ouvrage de construction de centres de formation professionnelle ou la maitrise d???ouvrage d??l??gu??e
             ?? la demande de minist??res, d???organismes, de projets nationaux, de coop??ration ou ?? la demande d???organismes priv??s tels que les branches, les ONG, 
             les associations et les entreprises.") }}</p>
        </div>

        <div class="col-md-6">
            <span class="fa-stack fa-4x">
              <i class="fas fa-circle fa-stack-2x text-primary"></i>
              <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
            </span>
              
          <h4 class="service-heading">{{ ("Recherche") }}</h4>
          <p class="text-muted">{{ ("Il s???agit de la production ou de la diffusion de connaissances et de savoirs sur la formation professionnelle.
             Ceci se traduit par l???appui ?? des th??ses ou des m??moires portant sur des sujets en lien avec les probl??matiques de la formation professionnelle. 
             Il s???agit ??galement de mise en oeuvre d?????tudes, de mise au point de m??thodes et d???exp??rimentation de moyens et ??quipements p??dagogiques. 
             Les r??sultats de recherche sont destin??s notamment ?? alimenter les politiques publiques et les programmes des branches professionnelles.") }}
            </p>
          </div>

      </div>
    </div>
  </section>
 
  <!-- About -->
  <section class="page-section" id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">A PROPOS</h2>
         {{--  <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> --}}
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <ul class="timeline">
            <li>
              <div class="timeline-image">
                <img class="rounded-circle img-fluid" src="#" alt="">
              </div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                 {{--  <h4>2009-2011</h4> --}}
                  <h4 class="subheading">{{ ("Qui sommes-nous ?") }}</h4>
                </div>
                <div class="timeline-body">
                  <p class="text-muted">{{ ("L???Office National de Formation Professionnelle (ONFP) est un ??tablissement public ?? caract??re industriel et commercial (EPIC) cr???? par la Loi n??86-44 du 11 Ao??t 1986.") }}</p>
                </div>
              </div>
            </li>
            <li class="timeline-inverted">
              <div class="timeline-image">
                <img class="rounded-circle img-fluid" src="#" alt="">
              </div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                 {{--  <h4>March 2011</h4> --}}
                  <h4 class="subheading">{{ ("Ainsi, l???ONFP a pour mission de :") }}</h4>
                </div>
                <div class="timeline-body">
                  <p class="text-muted">
                      {{ ("Aider ?? mettre en ??uvre les objectifs sectoriels du gouvernement et d???assister les organismes publics et priv??s dans la r??alisation de leur action ;") }}
                      {{ ("R??aliser des ??tudes sur l???emploi, la qualification professionnelle, les moyens quantitatifs et qualitatifs de la formation professionnelle initiale et continue ;") }}
                      {{ ("Coordonner les interventions par branche professionnelle par action prioritaire en s???appuyant sur des structures existantes ou ?? cr??er ;") }}
                      {{ ("Coordonner l???action de formation professionnelle des organismes d???aides bilat??rales ou multilat??rales.") }}
                    
                    </p>
                </div>
              </div>
            </li>
            <li>
              <div class="timeline-image">
                <img class="rounded-circle img-fluid" src="#" alt="">
              </div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                 {{--  <h4>December 2012</h4> --}}
                  <h4 class="subheading">{{ ("La vision qui guide notre action") }}</h4>
                </div>
                <div class="timeline-body">
                  <p class="text-muted">
                      {{ ("La qualification professionnelle est le levier le plus important pour l???am??lioration de la productivit?? du travail, la r??duction de la pr??carit?? de l???emploi et le positionnement fort de la formation professionnelle dans les enjeux nationaux.") }}
                  </p>
                </div>
              </div>
            </li>
            <li class="timeline-inverted">
              <div class="timeline-image">
                <img class="rounded-circle img-fluid" src="#" alt="">
              </div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                 {{--  <h4>July 2014</h4> --}}
                  <h4 class="subheading">{{ ("Les valeurs qui sous-tendent notre fonctionnement") }}</h4>
                </div>
                <div class="timeline-body">
                  <p class="text-muted">
                      {{ ("Nous portons en nous l???exigence scientifique et technique de la r??f??rence nationale en mati??re de formation professionnelle.") }}
                    </p>
                </div>
              </div>
            </li>
            <li>
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid" src="#" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                   {{--  <h4>December 2012</h4> --}}
                    <h4 class="subheading">{{ ("Le mandat assign?? ?? l???ONFP") }}</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">
                        {{ ("Doter le travailleur ou le demandeur d???emploi, notamment dans une optique d???auto emploi, o?? qu???il se trouve sur le territoire national, d???une qualification ou d???un titre professionnel qui lui permet, ?? la fois, d???occuper un emploi ou d???exercer une activit?? professionnelle selon les normes requises et de se promouvoir.") }}
                    </p>
                  </div>
                </div>
              </li>
           {{--  <li class="timeline-inverted">
              <div class="timeline-image">
                <h4>Be Part
                  <br>Of Our
                  <br>Story!</h4>
              </div>
            </li> --}}
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-light page-section" id="team">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">NOS CIBLES / BENEFICIAIRES</h2>
        {{--   <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> --}}
        </div>
      </div>
      <div class="row">
        <div class="mx-auto">
      <li>{{ ("Les travailleurs de tous secteurs (public, priv??, moderne, informel, monde rural, artisanat, etc.) ;") }}</li>
      <li>{{ ("Les individus ou groupe d???individus (en particulier les jeunes et les femmes) ?? la recherche d???un emploi ou porteurs de projets d???insertion ;") }}</li>
      <li>{{ ("Les entreprises de tous secteurs ;") }}</li>
      <li>{{ ("Les formateurs ;") }}</li>
      <li>{{ ("Les groupements f??minins ;") }}</li>
      <li>{{ ("Les Groupements d???int??r??t Economique (GIE) ;") }}</li>
      <li>{{ ("Les associations et ONG ;") }}</li>
      <li>{{ ("Les organisations professionnelles ;") }}</li>
      <li>{{ ("L???Etat et les collectivit??s locales ;") }}</li>
      <li>{{ ("Les chambres consulaires ;") }}</li>
      <li>{{ ("Les organisations de travailleurs ;") }}</li>
      <li>{{ ("Les partenaires internationaux intervenant dans le secteur de la formation professionnelle ou qualifiante dans le cadre de l???ex??cution de leurs programmes sp??cifiques ;") }}</li>
      <li>{{ ("Les chercheurs dans le domaine de la formation et de l???insertion professionnelle ;") }}</li>
      <li>{{ ("Les programmes d???investissements ??conomiques et de promotion de l???emploi.") }}</li>

        </div>
      </div>
    </div>
  </section>
  <!-- Contact -->
    <section class="page-section" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                  <h2 class="section-heading text-uppercase">Contactez Nous</h2>
                  {{-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> --}}
                </div>
              </div>
            <div class="row">
                <div class="col-lg-12 mx-auto">
                     <form id="contactForm" name="sentMessage" novalidate="novalidate">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" id="name" type="text" placeholder="Votre nom *" required="required" data-validation-required-message="svp. entrer votre nom.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <input class="form-control" id="email" type="email" placeholder="Votre Email *" required="required" data-validation-required-message="svp. entrer votre adress email.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <input class="form-control" id="phone" type="tel" placeholder="Votre Telephone *" required="required" data-validation-required-message="svp. entrer votre num??ro de t??l??phone.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <textarea class="form-control" id="message" placeholder="Votre Message *" required="required" data-validation-required-message="svp. entrer votre message."></textarea>
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-lg-12 text-center">
                <div id="success"></div>
                <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Envoyer un message</button>
              </div>
            </div>
          </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; ONFP 2021</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    {{-- <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> --}}

    <!-- Plugin JavaScript -->
    {{-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> --}}

    <!-- Custom JavaScript for this theme -->
    {{-- <script src="js/scrolling-nav.js"></script> --}}

    
  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Plugin JavaScript -->
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Contact form JavaScript -->
  <script src="{{ asset('js/jqBootstrapValidation.js') }}"></script>
  <script src="{{ asset('js/contact_me.js') }}"></script>

  <!-- Custom scripts for this template -->
  <script src="{{ asset('js/agency.min.js') }}"></script>

</body>

</html>
