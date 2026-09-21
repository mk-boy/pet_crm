<div class="overflow-hidden rounded-2xl bg-surface shadow-sm ring-1 ring-separator">
    <div class="overflow-x-auto">
        <table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-separator [&_td]:px-4 [&_td]:py-3 [&_td]:text-sm [&_td]:text-label [&_th]:px-4 [&_th]:py-3 [&_th]:text-start [&_th]:text-sm [&_th]:font-medium [&_th]:text-label-2 sm:[&_td]:px-6 sm:[&_th]:px-6']) }}>
            <thead>
                <tr>
                    {{ $head }}
                </tr>
            </thead>
            <tbody class="divide-y divide-separator">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
