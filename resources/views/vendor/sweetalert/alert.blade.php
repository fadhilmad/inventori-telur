@if (Session::has('alert.config') || Session::has('alert.delete'))
    @if (config('sweetalert.animation.enable'))
        <link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
    @endif

    @if (config('sweetalert.theme') != 'default')
        <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-{{ config('sweetalert.theme') }}" rel="stylesheet">
    @endif

    @if (config('sweetalert.alwaysLoadJS') === false && config('sweetalert.neverLoadJS') === false)
        <script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    @endif
    <script>
        @if (Session::has('alert.delete'))
            document.addEventListener('click', function(event) {
                if (event.target.matches('[data-confirm-delete]')) {
                    event.preventDefault();
                    Swal.fire({!! Session::pull('alert.delete') !!}).then(function(result) {
                        if (result.isConfirmed) {
                            var form = document.createElement('form');
                            var href = event.target.href ?? event.target.parentNode.href;
                            form.action = href;
                            form.method = 'POST';
                            form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                }
            });
        @endif

        @if (Session::has('alert.config'))
            @php
                $alertSession = Session::pull('alert.config');
                $toastConfig = json_decode($alertSession);
            @endphp
            @if (isset($toastConfig->toast) && $toastConfig->toast)
                Swal.fire({
                    "title": "{{ $toastConfig->title }}",
                    "text": "",
                    "timer": 3000,
                    "background": "#fff",
                    "padding": "1.25rem",
                    "showConfirmButton": false,
                    "showCloseButton": false,
                    "timerProgressBar": true,
                    "customClass": {
                        "container": null,
                        "popup": null,
                        "header": null,
                        "title": null,
                        "closeButton": null,
                        "icon": null,
                        "image": null,
                        "content": null,
                        "input": null,
                        "actions": null,
                        "confirmButton": null,
                        "cancelButton": null,
                        "footer": null
                    },
                    "toast": true,
                    "icon": "success",
                    "position": "top-end"
                });
            @else
                Swal.fire({!! $alertSession !!});
            @endif
        @endif
    </script>
@endif
