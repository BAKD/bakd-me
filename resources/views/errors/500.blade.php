<div class="content">
    <div class="title">Something went wrong.</div>

    @if(app()->bound('sentry') && !empty(Sentry::getLastEventID()))
        <div class="subtitle">Error ID: {{ Sentry::getLastEventID() }}</div>

        <!-- Sentry JS SDK 2.1.+ required -->
        <script src="https://cdn.ravenjs.com/3.3.0/raven.min.js"></script>

        <script>
            Raven.showReportDialog({
                dsn: "{{ env('SENTRY_LARAVEL_DSN') }}",
                eventId: '{{ Sentry::getLastEventID() }}',
                user: {
                    'name': "{{ app()->user() ? app()->user()->name : 'Guest' }}",
                    'email': "{{ app()->user() ? app()->user()->email : 'N/A' }}",
                }
            });
        </script>
    @endif
</div>