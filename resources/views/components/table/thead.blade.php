<thead {{ $attributes->merge(['class' => 'bg-slate-100 border-b-2 border-slate-300 text-slate-800 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-200']) }}>
    <tr>
        {{ $slot }}
    </tr>
</thead>
