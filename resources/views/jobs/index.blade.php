<x-layout>
    <x-slot:heading>
        Jobs
    </x-slot:heading>
    <div class="space-y-4">
        @foreach ($jobs as $job)
            <a href="/jobs/{{ $job['id'] }}" class=" bg-gray-300 block px-4 py-6 border border-gray-400 rounded-lg">
                <div class="font-bold text-blue-500 text-sm">{{ $job->employer->name }}</div>
                <div>
                    <strong class="text-larab">{{ $job['title'] }}:</strong> pays {{ $job['salary'] }} per
                    year
                </div>
            </a>
        @endforeach
        <div>
            {{ $jobs->links() }}
        </div>
    </div>
</x-layout>
