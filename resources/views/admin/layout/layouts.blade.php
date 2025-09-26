<!DOCTYPE html>
<html>
   <!-- Mirrored from adminlte.io/themes/AdminLTE/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jul 2025 12:58:31 GMT -->
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>AdminLTE 2 | Dashboard</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.7 -->
      <link rel="stylesheet" href="{{ asset('admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{ asset('admin/assets/bower_components/font-awesome/css/font-awesome.min.css')}}">
      <!-- Ionicons -->
      <link rel="stylesheet" href="{{ asset('admin/assets/bower_components/Ionicons/css/ionicons.min.css')}}">
      <link rel="stylesheet" href="{{ asset('admin/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('admin/assets/css/AdminLTE.min.css')}}">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="{{ asset('admin/assets/css/skins/_all-skins.min.css')}}">
      <!-- Morris chart -->
      <link rel="stylesheet" href="{{ asset('admin/assets/bower_components/morris.js/morris.css')}}">
      <!-- jvectormap -->
      <link rel="stylesheet" href="{{ asset('admin/assets/bower_components/jvectormap/jquery-jvectormap.css')}}">
      <!-- Date Picker -->
      <link rel="stylesheet" href="{{ asset('admin/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="{{ asset('admin/assets/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
      <!-- bootstrap wysihtml5 - text editor -->
      <link rel="stylesheet" href="{{ asset('admin/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- Google Font -->
      <link rel="stylesheet"
         href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
      <script data-cfasync="false" nonce="57de348f-8b69-4be1-9349-a008c0cff180">
         try {
             (function(w, d) {
                 ! function(fv, fw, fx, fy) {
                     if (fv.zaraz) console.error("zaraz is loaded twice");
                     else {
                         fv[fx] = fv[fx] || {};
                         fv[fx].executed = [];
                         fv.zaraz = {
                             deferred: [],
                             listeners: []
                         };
                         fv.zaraz._v = "5858";
                         fv.zaraz._n = "57de348f-8b69-4be1-9349-a008c0cff180";
                         fv.zaraz.q = [];
                         fv.zaraz._f = function(fz) {
                             return async function() {
                                 var fA = Array.prototype.slice.call(arguments);
                                 fv.zaraz.q.push({
                                     m: fz,
                                     a: fA
                                 })
                             }
                         };
                         for (const fB of ["track", "set", "debug"]) fv.zaraz[fB] = fv.zaraz._f(fB);
                         fv.zaraz.init = () => {
                             var fC = fw.getElementsByTagName(fy)[0],
                                 fD = fw.createElement(fy),
                                 fE = fw.getElementsByTagName("title")[0];
                             fE && (fv[fx].t = fw.getElementsByTagName("title")[0].text);
                             fv[fx].x = Math.random();
                             fv[fx].w = fv.screen.width;
                             fv[fx].h = fv.screen.height;
                             fv[fx].j = fv.innerHeight;
                             fv[fx].e = fv.innerWidth;
                             fv[fx].l = fv.location.href;
                             fv[fx].r = fw.referrer;
                             fv[fx].k = fv.screen.colorDepth;
                             fv[fx].n = fw.characterSet;
                             fv[fx].o = (new Date).getTimezoneOffset();
                             if (fv.dataLayer)
                                 for (const fF of Object.entries(Object.entries(dataLayer).reduce(((fG, fH) => ({
                                         ...fG[1],
                                         ...fH[1]
                                     })), {}))) zaraz.set(fF[0], fF[1], {
                                     scope: "page"
                                 });
                             fv[fx].q = [];
                             for (; fv.zaraz.q.length;) {
                                 const fI = fv.zaraz.q.shift();
                                 fv[fx].q.push(fI)
                             }
                             fD.defer = !0;
                             for (const fJ of [localStorage, sessionStorage]) Object.keys(fJ || {}).filter((fL => fL
                                 .startsWith("_zaraz_"))).forEach((fK => {
                                 try {
                                     fv[fx]["z_" + fK.slice(7)] = JSON.parse(fJ.getItem(fK))
                                 } catch {
                                     fv[fx]["z_" + fK.slice(7)] = fJ.getItem(fK)
                                 }
                             }));
                             fD.referrerPolicy = "origin";
                             fD.src = "../../cdn-cgi/zaraz/sd0d9.js?z=" + btoa(encodeURIComponent(JSON.stringify(fv[
                                 fx])));
                             fC.parentNode.insertBefore(fD, fC)
                         };
                         ["complete", "interactive"].includes(fw.readyState) ? zaraz.init() : fv.addEventListener(
                             "DOMContentLoaded", zaraz.init)
                     }
                 }(w, d, "zarazData", "script");
                 window.zaraz._p = async eC => new Promise((eD => {
                     if (eC) {
                         eC.e && eC.e.forEach((eE => {
                             try {
                                 const eF = d.querySelector("script[nonce]"),
                                     eG = eF?.nonce || eF?.getAttribute("nonce"),
                                     eH = d.createElement("script");
                                 eG && (eH.nonce = eG);
                                 eH.innerHTML = eE;
                                 eH.onload = () => {
                                     d.head.removeChild(eH)
                                 };
                                 d.head.appendChild(eH)
                             } catch (eI) {
                                 console.error(`Error executing script: ${eE}\n`, eI)
                             }
                         }));
                         Promise.allSettled((eC.f || []).map((eJ => fetch(eJ[0], eJ[1]))))
                     }
                     eD()
                 }));
                 zaraz._p({
                     "e": ["(function(w,d){})(window,document)"]
                 });
             })(window, document)
         } catch (e) {
             throw fetch("/cdn-cgi/zaraz/t"), e;
         };
      </script>
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">
        @include('admin.layout.header')

        @include('admin.layout.sidebar')

        @yield('content')
        @show

        @include('admin.layout.footer')
         <!-- Control Sidebar -->
         <aside class="control-sidebar control-sidebar-dark" style="display: none;">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
               <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
               <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <!-- Home tab content -->
               <div class="tab-pane" id="control-sidebar-home-tab">
                  <h3 class="control-sidebar-heading">Recent Activity</h3>
                  <ul class="control-sidebar-menu">
                     <li>
                        <a href="javascript:void(0)">
                           <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                           <div class="menu-info">
                              <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                              <p>Will be 23 on April 24th</p>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="javascript:void(0)">
                           <i class="menu-icon fa fa-user bg-yellow"></i>
                           <div class="menu-info">
                              <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                              <p>New phone +1(800)555-1234</p>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="javascript:void(0)">
                           <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                           <div class="menu-info">
                              <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                              <p><span class="__cf_email__"
                                 data-cfemail="c5abaab7a485a0bda4a8b5a9a0eba6aaa8">[email&#160;protected]</span>
                              </p>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="javascript:void(0)">
                           <i class="menu-icon fa fa-file-code-o bg-green"></i>
                           <div class="menu-info">
                              <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                              <p>Execution time 5 seconds</p>
                           </div>
                        </a>
                     </li>
                  </ul>
                  <!-- /.control-sidebar-menu -->
                  <h3 class="control-sidebar-heading">Tasks Progress</h3>
                  <ul class="control-sidebar-menu">
                     <li>
                        <a href="javascript:void(0)">
                           <h4 class="control-sidebar-subheading">
                              Custom Template Design
                              <span class="label label-danger pull-right">70%</span>
                           </h4>
                           <div class="progress progress-xxs">
                              <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="javascript:void(0)">
                           <h4 class="control-sidebar-subheading">
                              Update Resume
                              <span class="label label-success pull-right">95%</span>
                           </h4>
                           <div class="progress progress-xxs">
                              <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="javascript:void(0)">
                           <h4 class="control-sidebar-subheading">
                              Laravel Integration
                              <span class="label label-warning pull-right">50%</span>
                           </h4>
                           <div class="progress progress-xxs">
                              <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="javascript:void(0)">
                           <h4 class="control-sidebar-subheading">
                              Back End Framework
                              <span class="label label-primary pull-right">68%</span>
                           </h4>
                           <div class="progress progress-xxs">
                              <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                           </div>
                        </a>
                     </li>
                  </ul>
                  <!-- /.control-sidebar-menu -->
               </div>
               <!-- /.tab-pane -->
               <!-- Stats tab content -->
               <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
               <!-- /.tab-pane -->
               <!-- Settings tab content -->
               <div class="tab-pane" id="control-sidebar-settings-tab">
                  <form method="post">
                     <h3 class="control-sidebar-heading">General Settings</h3>
                     <div class="form-group">
                        <label class="control-sidebar-subheading">
                        Report panel usage
                        <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                           Some information about this general settings option
                        </p>
                     </div>
                     <!-- /.form-group -->
                     <div class="form-group">
                        <label class="control-sidebar-subheading">
                        Allow mail redirect
                        <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                           Other sets of options are available
                        </p>
                     </div>
                     <!-- /.form-group -->
                     <div class="form-group">
                        <label class="control-sidebar-subheading">
                        Expose author name in posts
                        <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                           Allow the user to show his name in blog posts
                        </p>
                     </div>
                     <!-- /.form-group -->
                     <h3 class="control-sidebar-heading">Chat Settings</h3>
                     <div class="form-group">
                        <label class="control-sidebar-subheading">
                        Show me as online
                        <input type="checkbox" class="pull-right" checked>
                        </label>
                     </div>
                     <!-- /.form-group -->
                     <div class="form-group">
                        <label class="control-sidebar-subheading">
                        Turn off notifications
                        <input type="checkbox" class="pull-right">
                        </label>
                     </div>
                     <!-- /.form-group -->
                     <div class="form-group">
                        <label class="control-sidebar-subheading">
                        Delete chat history
                        <a href="javascript:void(0)" class="text-red pull-right"><i
                           class="fa fa-trash-o"></i></a>
                        </label>
                     </div>
                     <!-- /.form-group -->
                  </form>
               </div>
               <!-- /.tab-pane -->
            </div>
         </aside>
         <!-- /.control-sidebar -->
         <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
         <div class="control-sidebar-bg"></div>
      </div>
      <!-- ./wrapper -->
      <!-- jQuery 3 -->
      <script data-cfasync="false" src="{{ asset('admin/assets/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script>
      <script src="{{ asset('admin/assets/bower_components/jquery/dist/jquery.min.js')}}"></script>
      <!-- jQuery UI 1.11.4 -->
      <script src="{{ asset('admin/assets/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
      <script>
         $.widget.bridge('uibutton', $.ui.button);
      </script>
      <!-- Bootstrap 3.3.7 -->
      <script src="{{ asset('admin/assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
      <!-- Morris.js charts -->
      <script src="{{ asset('admin/assets/bower_components/raphael/raphael.min.js')}}"></script>
      <script src="{{ asset('admin/assets/bower_components/morris.js/morris.min.js')}}"></script>
      <!-- Sparkline -->
      <script src="{{ asset('admin/assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
      <!-- jvectormap -->
      <script src="{{ asset('admin/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
      <script src="{{ asset('admin/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
      <!-- jQuery Knob Chart -->
      <script src="{{ asset('admin/assets/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
      <!-- daterangepicker -->
      <script src="{{ asset('admin/assets/bower_components/moment/min/moment.min.js')}}"></script>
      <script src="{{ asset('admin/assets/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
      <!-- datepicker -->
      <script src="{{ asset('admin/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
      <!-- Bootstrap WYSIHTML5 -->
      <script src="{{ asset('admin/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
      <!-- Slimscroll -->
      <script src="{{ asset('admin/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
      <!-- FastClick -->
      <script src="{{ asset('admin/assets/bower_components/fastclick/lib/fastclick.js')}}"></script>
      <script src="{{ asset('admin/assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
      <script src="{{ asset('admin/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
      <!-- AdminLTE App -->
      <script src="{{ asset('admin/assets/js/adminlte.min.js')}}"></script>
      <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
      <script src="{{ asset('admin/assets/js/pages/dashboard.js')}}"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="{{ asset('admin/assets/js/demo.js')}}"></script>
      <script src="ad.js"></script>
      <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
         integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
         data-cf-beacon='{"rayId":"9643969d4bac8ae8","version":"2025.7.0","serverTiming":{"name":{"cfExtPri":true,"cfEdge":true,"cfOrigin":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"token":"2437d112162f4ec4b63c3ca0eb38fb20","b":1}'
         crossorigin="anonymous"></script>
   </body>
   <!-- Mirrored from adminlte.io/themes/AdminLTE/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jul 2025 12:58:34 GMT -->

<script>
  $(function () {
    $('#userManagementTable').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</html>
