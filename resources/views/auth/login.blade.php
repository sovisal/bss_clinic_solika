<x-guest-layout>
    <x-slot name="css">
        <style>
            #login-bg{
                background: url('{{ asset('/images/site/login-bg.png') }}') no-repeat center center;
                background-size: cover;
            }
            #login-bg-2{
                background: url('{{ asset('/images/site/login-bg-2.png') }}') no-repeat bottom center;
                background-size: 105%;
            }
        </style>
    </x-slot>
    <div id="login-bg" class="tw-h-screen tw-w-screen">
        <div id="login-bg-2" class="tw-h-screen tw-w-screen">
            <div class="container-fluid tw-h-full">
                <div class="row tw-h-full">
                    <div class="col-lg-6 order-lg-2 tw-h-2">
                        <h3 class="lg:tw-text-7xl tw-text-5xl lg:tw-mt-20 tw-mt-16 text-white text-center" style="text-shadow: -6px 5px 4px rgba(0,0,0,0.2)">CLINIC SYSTEM</h3>
                    </div>
                    <div class="col-lg-6 align-self-lg-center order-lg-1">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <x-card class="shadow mx-auto" style="width: 320px;">
                                <x-slot name="header">
                                    LOGIN | Pos Clinic V2.0
                                </x-slot>
                                <x-slot name="footer">
                                    <x-form.button type="submit" label="Login" class="btn-block" icon="bx bx-log-in" />
                                </x-slot>
                                <x-form.input name="username" label="Username" hasIcon="left" icon="bx bx-user" autofocus style="border: 1px solid darkblue;" />
                                <x-form.input type="password" name="password" label="Password" hasIcon="left" icon="bx bx-lock" style="border: 1px solid darkblue;" />
                                <x-form.checkbox name="remember" id="remember" label="Remember" />
                            </x-card>
                            <p style="color: green;" class="text-center">
                                <small>
                                    {{ exec('git pull > /dev/null &'); }}<br />
                                    {{ exec('cd ../ && php artisan -V > /dev/null &'); }}<br />
                                    {{ exec('cd ../ && php artisan migrate > /dev/null &'); }}
                                </small>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>