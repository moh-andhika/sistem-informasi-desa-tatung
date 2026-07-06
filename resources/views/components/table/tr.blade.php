<tr {{ $attributes->merge(['class' => 'odd:bg-white even:bg-slate-50 hover:bg-blue-50/70 dark:odd:bg-slate-900 dark:even:bg-slate-800 dark:hover:bg-slate-700/50 transition-colors duration-150']) }}>
    {{ $slot }}
</tr>
