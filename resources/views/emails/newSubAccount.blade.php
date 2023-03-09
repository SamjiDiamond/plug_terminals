@component('mail::message')
    # New Account

    Hi {{$datas['name']}},

    An account has been created for you on {{$datas['businessName']}}.

    Find below your login credentials.
    Agent ID: {{$datas['agent_id']}}
    Email: {{$datas['email']}}
    Password: {{$datas['password']}}

    @slot('subcopy')
        You received this email because an Agency created an account for you on {{ config('app.name') }}.
    @endslot

    Thanks,
    {{ config('app.name') }}
@endcomponent
