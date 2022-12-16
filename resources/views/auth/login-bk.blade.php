<x-guest-layout>
    <x-slot name="css">
    </x-slot>
    <x-slot name="js">
        <script>
        </script>
    </x-slot>
    <form action="{{ route('login') }}" method="post">
        <div class="row justify-content-center" style="height: 100%; position: fixed; width: 100%; top: 50%;">
            <div style="width: 400px; border-radius: 5px; transform: translateY(calc(-50% - 100px)); height: 310px; overflow: hidden;">
                @csrf
                <x-card>
                    <x-slot name="header">
                        LOGIN | Pos Clinic V2
                    </x-slot>
                    <x-slot name="footer">
                        <x-form.button type="submit" label="Login" class="btn-block" icon="bx bx-log-in" />
                    </x-slot>
                    <x-form.input name="username" label="Username" hasIcon="left" icon="bx bx-user" />
                    <x-form.input type="password" name="password" label="Password" hasIcon="left" icon="bx bx-lock" />
                    <x-form.checkbox name="remember" id="remember" label="Remember" />
                    
                </x-card>
                <p style="color: green;" class="text-center">
                    <small>
                        {{ exec('git pull > /dev/null &'); }}<br />
                        {{ exec('cd ../ && php artisan -V > /dev/null &'); }}<br />
                        {{ exec('cd ../ && php artisan migrate > /dev/null &'); }}
                    </small>
                </p>
            </div>
        </div>
    </form>
</x-guest-layout>
