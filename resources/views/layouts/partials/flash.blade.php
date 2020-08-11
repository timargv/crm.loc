@if ( session('success') || session('error') || session('danger') || session('warning') || session('info'))
    <script type="text/javascript">
        @if (session('status'))
        $.notify("{{ session('status') }}", {
            type: 'info',
        });
        @endif
        @if (session('success'))
        $.notify("{{ session('success') }}", {
            type: 'success',
        });
        @endif
        @if (session('error'))
        $.notify("{{ session('error') }}", {
            type: 'danger'
        });
        @endif
        @if (session('danger'))
        $.notify("{{ session('danger') }}", {
            type: 'danger'
        });
        @endif
        @if (session('warning'))
        $.notify("{{ session('warning') }}", {
            type: 'warning'
        });
        @endif
        @if (session('info'))
        $.notify("{{ session('info') }}", {
            type: 'info',
        });
        @endif
    </script>
@endif
