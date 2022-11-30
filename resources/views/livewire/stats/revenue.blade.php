<x-stat-layout name="Revenue" :stat="(new NumberFormatter('un-US', NumberFormatter::CURRENCY))->formatCurrency($revenue/100, 'USD')"></x-stat-layout>

