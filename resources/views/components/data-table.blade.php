@props([
'href',
'filter' => [],
'dateFilter' => false
])

<div class="w-full md:p-4 mb-4 md:mb-0 flex justify-start flex-wrap">
    <div class="flex w-1/3 md:w-auto mr-auto order-1 px-px">
        <x-select id="perpage" onchange="search()" class="block w-full">
            <option value="100" {{ request()->perpage == 100 ? 'selected' : '' }}>100</option>
            <option value="50" {{ request()->perpage == 50 ? 'selected' : '' }}>50</option>
            <option value="25" {{ request()->perpage == 25 ? 'selected' : '' }}>25</option>
            <option value="15" {{ request()->perpage == 15 ? 'selected' : '' }}>15</option>
        </x-select>
    </div>

    <div class="flex w-2/3 md:w-auto order-last px-px">
        <x-input id="search" oninput="search()" class="block w-full" type="search" value="{{ request()->search ?? '' }}"
            placeholder="Search here ..." />
    </div>

    @if(count($filter) > 0)
    <div class="w-full md:w-auto flex-auto justify-center items-center flex order-first md:order-2">
        <div class="w-full md:w-auto flex flex-wrap md:pb-0 pb-4">
            @foreach($filter as $key => $value)
            <div class="flex md:w-auto w-1/2 justify-center">
                <x-select onchange="search()" :name="$key" class="filter block w-full mx-px max-w-xs">
                    <option value="" selected> {{ str_replace('_', ' ', ucfirst($key)) }} (All)</option>
                    @foreach($value as $id => $name)
                    <option value="{{ $id }}" {{ request($key) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                    @endforeach
                </x-select>
            </div>
            @endforeach

            @if($dateFilter)
            <div class="flex md:w-auto w-full justify-center">
                <x-select id="day" name="day" class="filter block w-full mx-px">
                    <option value="" selected> All Date</option>
                    <option value="7"> Last 7 days</option>
                    <option value="15"> Last 15 days</option>
                    <option value="30"> Last 30 days</option>
                    <option value="90"> Last 90 days</option>
                </x-select>
            </div>

            <div id="dateFromContainer" class="flex md:w-auto w-1/2 justify-center">
                <x-input oninput="search()" name="from" type="date" class="filter block w-full mx-px" />
            </div>
            <div id="dateToContainer" class="flex md:w-auto w-1/2 justify-center">
                <x-input oninput="search()" name="to" type="date" class="filter block w-full mx-px" />
            </div>

            <script>
                const day = document.getElementById('day');
                const dateFromContainer = document.getElementById('dateFromContainer');
                const dateToContainer = document.getElementById('dateToContainer');

                day.onchange = (event) => {
                    if(event.target.value) {
                        dateFromContainer.innerHTML = ''
                        dateToContainer.innerHTML = ''
                    } else {
                        dateFromContainer.innerHTML = `<x-input oninput="search()" name="from" type="date" class="filter block w-full mx-px" />`;
                        dateToContainer.innerHTML = `<x-input oninput="search()" name="to" type="date" class="filter block w-full mx-px" />`;
                    }

                    search();
                } 
            </script>
            @endif
        </div>
    </div>
    @endif

</div>

<div class="bg-white shadow-md rounded overflow-auto md:mx-4 relative">
    <table class="min-w-max w-full table-auto">
        <thead>
            {{ $slot }}
        </thead>

        <tbody class="text-gray-600 text-sm font-light" id="tableBody">
            <tr>
                <td colspan="100">
                    <p class="md:text-6xl text-2xl py-24 text-center">Processing...</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>


<script>
    function search(url = '{{ $href }}') {
       
        const data = { flag: true }

        data.perpage = document.getElementById('perpage').value

        document.querySelectorAll('.filter').forEach(element => {
            data[element.name] = element.value;
        });

        const text = document.getElementById('search').value.trim();

        data.search = text.replaceAll(" ", "|"),

        axios.get(url, {
            params : data
        })
        .then(function (response) {
            document.getElementById('tableBody').innerHTML = response.data;
            
            const __paginationLinkContainer__ = document.getElementById('__paginationLinkContainer__');

            let sl = 0;

            __paginationLinkContainer__.querySelectorAll('a').forEach((__paginationLink__) => {
                let href = __paginationLink__.getAttribute('href');

                __paginationLink__.onclick = () => { search(href);  };

                __paginationLink__.setAttribute('href', 'javascript:void(0)');
            });
        })
        .catch(function (error) {
            console.log(error);
        });  

        let params = '';

        let paramSeparator = '';

        Object.entries(data).forEach(param => {
            if(param[0] == 'flag' || !param[1]) {
                return;
            }

            params = `${params}${paramSeparator}${param[0]}=${param[1]}`;
            
            if(!paramSeparator) {
                paramSeparator = '&';
            }
        });

        let excelDownload = document.querySelector('#excelDownload')

        if(excelDownload) {
            excelDownload.href = excelDownload.href.split('?')[0] + '?flag=true&' + params + '&excel=true';
        }

        let urlParams = new URLSearchParams(url.split('?')[1] || '') || '';

        let page = urlParams.get('page') || '1';

        let historyUrl = url.split('?')[0] + '?page=' + page + '&' + params.replaceAll("|", "+");

        historyTitle = document.title;

        historyState = {}

        localStorage.setItem('historyUrl', historyUrl);

        window.history.pushState(historyState, historyTitle, historyUrl);
        
    }

    function changeHistory() {
        
    }

    window.onload = () => {
        search(window.location.href);
    };

</script>