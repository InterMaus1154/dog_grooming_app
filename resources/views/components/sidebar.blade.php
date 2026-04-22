<aside :class="open ? 'w-60 sm:w-80' : 'w-0 overflow-hidden'"
       class="shrink-0 bg-gray-800 text-white transition-all duration-300 h-full">
    <p class="text-red-500">Content</p>
    <button @click="open = !open">Toggle</button>
</aside>
