<x-layout>
    <x-slot:heading>
        Jobs
    </x-slot:heading>
    <ul>
        @foreach ($jobs as $job)
            <li>
                <a href="/jobs/{{ $job['id'] }}" class="hover:text-blue-800 hover:underline">
                    <strong>{{ $job['title'] }}:</strong> pays {{ $job['salary'] }} per year
                </a>
            </li>
        @endforeach
    </ul>
</x-layout>
