<x-guest-layout>
    <div class="container-fluid">
        <div class="row">
            @php
                $columnSize =  '12';
            @endphp
            <div class="col-xl-{{ $columnSize }} p-0">
                <div class="login-card login-dark" style="background: url('{{ asset('assets/images/login/login_bg.jpg') }}');">
                    <div>
                        <div><a class="logo text-center" href="{{ url('/') }}">
                                <img  style="width: 40%;" class="img-fluid for-light" src="{{ asset('assets/images/logo/happyhome-logo.png') }}" alt="looginpage" >
                                <img  style="width: 40%;" class="img-fluid for-dark" src="../assets/images/logo/happyhome-logo.png" alt="looginpage"></a>
                        </div>
                        <div class="login-main">
                            <form class="theme-form"  method="POST" action="{{ route('login') }}">
                                @csrf
                                <h3>Sign in to account</h3>
                                <p>Enter your email & password to login</p>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input
                                        class="form-control"
                                        name="email"
                                        type="email"
                                        value="{{ old('email') }}"
                                        placeholder="test@gmail.com"
                                        autocomplete="email">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <div class="form-input position-relative">
                                        <input
                                            class="form-control"
                                            type="password"
                                            name="password"
                                            required=""
                                            placeholder="*********"
                                            autocomplete="current-password">
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input id="checkbox1" name="remember" type="checkbox">
                                        <label class="text-muted" for="checkbox1">Remember password</label>
                                    </div>
                                    <a class="link" href="{{ route('password.request') }}">Forgot password?</a>
                                    <button class="btn btn-yellow btn-block w-100" type="submit">Sign in</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
