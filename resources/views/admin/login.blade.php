<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/assets/bower_components/Ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/iCheck/square/blue.css')}}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script data-cfasync="false" nonce="2fc3f127-0555-446d-9e6c-63c7ed5d267b">
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
                        fv.zaraz._n = "2fc3f127-0555-446d-9e6c-63c7ed5d267b";
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
                            fD.src = "../../../../cdn-cgi/zaraz/sd0d9.js?z=" + btoa(encodeURIComponent(JSON
                                .stringify(fv[fx])));
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

<style>
    body.login-page {
        background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d);
        color: #fff;
        font-family: 'Source Sans Pro', sans-serif;
    }

    .login-box-body {
        background-color: #2c2c2c;
        color: #f1f1f1;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.6);
    }

    .login-box .login-logo a {
        color: #ffffff;
        font-size: 30px;
        font-weight: bold;
    }

    .form-control {
        background-color: #444;
        border: 1px solid #666;
        color: #fff;
    }

    .form-control::placeholder {
        color: #aaa;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .login-box-msg {
        color: #ccc;
        margin-bottom: 20px;
        font-size: 16px;
    }

    .checkbox label {
        color: #ccc;
    }

    a {
        color: #00c0ef;
    }

    a:hover {
        color: #ffffff;
    }
</style>


<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Admin</b>LTE</a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

           @if(Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> {{ Session::get('error_message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success:</strong> {{ Session::get('success_message') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

            <form action="{{ url('admin/login') }}" method="post">
                @csrf
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>

                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </div>
            </form>
            <a href="{{ route('admin.forgot.password') }}">I forgot my password</a><br>
        </div>
    </div>
    <script src="{{ asset('admin/assets/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('admin/assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('admin/assets/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
        });
    </script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
        integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
        data-cf-beacon='{"rayId":"964396bf89f65970","version":"2025.7.0","serverTiming":{"name":{"cfExtPri":true,"cfEdge":true,"cfOrigin":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"token":"2437d112162f4ec4b63c3ca0eb38fb20","b":1}'
        crossorigin="anonymous"></script>
</body>
</html>
