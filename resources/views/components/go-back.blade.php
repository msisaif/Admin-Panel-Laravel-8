@props([
'href' => '#'
])

<span onclick="goBack(this)"
    {{ $attributes->merge(['class' => 'text-center font-bold cursor-pointer border border-purple-500 text-purple-600 hover:bg-purple-500 hover:text-white rounded-lg px-3 py-1.5']) }}>
    {!! 'Go to list' !!}
</span>

<script>
    function goBack(element){
        let historyUrl = localStorage.getItem('historyUrl');

        if(historyUrl) {
            window.location.href = historyUrl;
        }else {
            window.location.href = '{{ $href }}';
        }
    }
</script>