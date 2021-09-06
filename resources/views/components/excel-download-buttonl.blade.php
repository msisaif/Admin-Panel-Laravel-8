@props(['href'])

<a id="excelDownload" href="{{ $href }}" {{ $attributes }}
    class="ml-auto flex items-center justify-center text-center font-bold cursor-pointer border border-purple-500 text-white  hover:bg-purple-600 bg-purple-500 rounded-lg px-2 py-1.5">
    <span>Excel</span>
    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
    </svg>
</a>