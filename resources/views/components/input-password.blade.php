@props([
    'disabled' => false,
    'generator' => false,
])

<div class="relative">
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '__password rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}>

    <svg onclick="toggle('text')" class="eye__open absolute w-5 top-2.5 right-4 cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
        <path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z"/>
    </svg>

    <svg onclick="toggle('password')" class="eye__close hidden absolute w-5 top-2.5 right-4 cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
        <path d="M0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0z" fill="none"/><path d="M12 6c3.79 0 7.17 2.13 8.82 5.5-.59 1.22-1.42 2.27-2.41 3.12l1.41 1.41c1.39-1.23 2.49-2.77 3.18-4.53C21.27 7.11 17 4 12 4c-1.27 0-2.49.2-3.64.57l1.65 1.65C10.66 6.09 11.32 6 12 6zm-1.07 1.14L13 9.21c.57.25 1.03.71 1.28 1.28l2.07 2.07c.08-.34.14-.7.14-1.07C16.5 9.01 14.48 7 12 7c-.37 0-.72.05-1.07.14zM2.01 3.87l2.68 2.68C3.06 7.83 1.77 9.53 1 11.5 2.73 15.89 7 19 12 19c1.52 0 2.98-.29 4.32-.82l3.42 3.42 1.41-1.41L3.42 2.45 2.01 3.87zm7.5 7.5l2.61 2.61c-.04.01-.08.02-.12.02-1.38 0-2.5-1.12-2.5-2.5 0-.05.01-.08.01-.13zm-3.4-3.4l1.75 1.75c-.23.55-.36 1.15-.36 1.78 0 2.48 2.02 4.5 4.5 4.5.63 0 1.23-.13 1.77-.36l.98.98c-.88.24-1.8.38-2.75.38-3.79 0-7.17-2.13-8.82-5.5.7-1.43 1.72-2.61 2.93-3.53z"/>
    </svg>

    <div onclick="generator()" class="{{ $generator ? 'flex' : 'hidden' }} text-green-600 py-px  absolute -top-7 right-4 cursor-pointer">
        <span class="pr-2 font-semibold text-gray-600">Generator</span>
        <svg  xmlns="http://www.w3.org/2000/svg" class="w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
        </svg>
    </div>
</div>

<script>
    function toggle(value){
        document.querySelector('.__password').setAttribute('type', value)
        document.querySelector('.eye__open').classList.toggle('hidden')
        document.querySelector('.eye__close').classList.toggle('hidden')
    }

    function generator(min = 111111, max = 999999){
        toggle('text')
        document.querySelector('.__password').value = Math.floor(Math.random() * (max - min) ) + min
        // document.querySelector('.__password').value = generatePassword(8)
    }

    function generatePassword(passwordLength) {
        var numberChars = "0123456789"
        var upperChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
        var lowerChars = "abcdefghijklmnopqrstuvwxyz"
        // var spacial = "~!@#$%^&*()_-+=/|`"
        var allChars = numberChars + upperChars + lowerChars // + spacial
        var randPasswordArray = Array(passwordLength)
        randPasswordArray[0] = numberChars
        randPasswordArray[1] = upperChars
        randPasswordArray[2] = lowerChars
        // randPasswordArray[3] = spacial
        randPasswordArray = randPasswordArray.fill(allChars, 3)
        return shuffleArray(randPasswordArray.map(function(x) { return x[Math.floor(Math.random() * x.length)] })).join('')
    }

    function shuffleArray(array) {
        for (var i = array.length - 1; i > 0; i--) {
            var j = Math.floor(Math.random() * (i + 1))
            var temp = array[i]
            array[i] = array[j]
            array[j] = temp
        }
        return array
    }
</script>