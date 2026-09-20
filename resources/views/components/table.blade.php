<div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-gray-200 dark:divide-gray-700 [&_th]:px-6 [&_th]:py-3 [&_th]:text-start [&_th]:text-xs [&_th]:font-medium [&_th]:uppercase [&_th]:tracking-widest [&_th]:text-gray-500 dark:[&_th]:text-gray-400 [&_td]:px-6 [&_td]:py-4 [&_td]:text-sm [&_td]:text-gray-900 dark:[&_td]:text-gray-100']) }}>
            <thead class="bg-gray-50 dark:bg-gray-900/50">
                <tr>{{ $head }}</tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
