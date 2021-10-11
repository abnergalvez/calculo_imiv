<script>
    const notyf = new Notyf({
        position: {
            x: 'right',
            y: 'top',
        }});

        // Display a notification
        @if(session('status'))
            notyf.{{ session()->get('status')['type'] }}({
                message: '{{ session()->get('status')['message'] }}',
                duration: {{session()->get('status')['time'] }}*1000,
            });
        @endif

        @php 
            session()->forget('status'); 
        @endphp

</script>