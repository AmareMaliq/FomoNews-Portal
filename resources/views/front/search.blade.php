@extends('front.master')
@section('content')
	<body class="font-[Poppins]">
		<x-navbar/>
		{{-- <nav id="Category" class="max-w-[1130px] mx-auto flex justify-center items-center gap-4 mt-[30px]">
			@foreach ($categories as $category)
			<a href="{{ route('front.category', $category->slug) }}" class="rounded-full p-[12px_22px] flex gap-[10px] font-semibold transition-all duration-300 border border-[#EEF0F7] hover:ring-2 hover:ring-[#FF6B18]">
				<div class="w-6 h-6 flex shrink-0">
					<img src="{{ Storage::url($category->icon) }}" alt="icon" />
				</div>
				<span>{{ $category->name }}</span>
			</a>
			@endforeach
		</nav> --}}
		<div class="relative max-w-[1300px] mx-auto mt-[30px]">
			<!-- Tombol Previous -->
			<button 
			id="prev" 
			class="absolute left-[-50px] top-1/2 hidden -translate-y-1/2 z-10 p-3 bg-white border border-gray-200 rounded-full shadow-md hover:bg-gray-100"
			>
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-700">
				<path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
			</svg>
			</button>
			<nav id="Category" class="flex gap-4 cursor-grab active:cursor-grabbing overflow-hidden">
				<div id="CategoryInner" class="flex transition-transform space-x-2 duration-300 py-6 px-6">
					@foreach ($categories as $category)
					<a 
						href="{{ route('front.category', $category->slug) }}" 
						class="rounded-full p-[12px_22px] flex gap-[10px] font-semibold transition-all duration-300 hover:ring-2 hover:ring-[#FF6B18] {{ Request::is('category/' . $category->slug) ? 'border-4 border-[#FF6B18]' : 'border border-[#EEF0F7]' }}">
						<div class="w-6 h-6 flex shrink-0">
							<img src="{{ Storage::url($category->icon) }}" alt="icon" />
						</div>
						<span>{{ $category->name }}</span>
					</a>
					@endforeach
				</div>
			</nav>
			<!-- Tombol Next -->
			<button 
			id="next" 
			class="absolute right-[-40px] top-1/2 hidden -translate-y-1/2 z-10 p-3 bg-white border border-gray-200 rounded-full shadow-md hover:bg-gray-100"
			>
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-700">
					<path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
				</svg>
			</button>
		</div>

		<section id="heading" class="max-w-[1130px] mx-auto flex items-center flex-col gap-[30px] mt-[70px]">
			<h1 class="text-4xl leading-[45px] font-bold text-center">
				Explore Hot Trending <br />
				Good News Today
			</h1>
			{{-- <form action="{{ route('front.search') }}" method="get">
				<label for="search-bar" class="w-[500px] flex p-[12px_20px] transition-all duration-300 gap-[10px] ring-1 ring-[#E8EBF4] focus-within:ring-2 focus-within:ring-[#FF6B18] rounded-[50px] group">
					<div class="w-5 h-5 flex shrink-0">
						<img src="{{ asset('assets/images/icons/search-normal.svg')}}" alt="icon" />
					</div>
					<input
						autocomplete="off"
						type="text"
						id="search-bar"
						name="keywords"
						placeholder="Search hot trendy news today..."
						class="appearance-none font-semibold placeholder:font-normal placeholder:text-[#A3A6AE] outline-none focus:ring-0 w-full"
					/>
				</label>
			</form> --}}
		</section>
		<section id="search-result" class="max-w-[1130px] mx-auto flex items-start flex-col gap-[30px] mt-[70px] mb-[100px]">
			<h2 class="text-[26px] leading-[39px] font-bold">Search Result: <span>{{ ucfirst($keywords) }}</span></h2>
			<div id="search-cards" class="grid grid-cols-3 gap-[30px]">
        @forelse ($articles as $article )
        <a href="{{ route('front.details',$article->slug) }}" class="card">
					<div class="flex flex-col gap-4 p-[26px_20px] transition-all duration-300 ring-1 ring-[#EEF0F7] hover:ring-2 hover:ring-[#FF6B18] rounded-[20px] overflow-hidden bg-white">
						<div class="thumbnail-container h-[200px] relative rounded-[20px] overflow-hidden">
							<div class="badge absolute left-5 top-5 bottom-auto right-auto flex p-[8px_18px] bg-white rounded-[50px]">
								<p class="text-xs leading-[18px] font-bold">{{ $article->category->name }}</p>
							</div>
							<img src="{{ Storage::url($article->thumbnail)}}" alt="thumbnail photo" class="w-full h-full object-cover" />
						</div>
						<div class="flex flex-col gap-[6px]">
							<h3 class="text-lg leading-[27px] font-bold">	{{ Str::limit($article->name,57) }}</h3>
							<p class="text-sm leading-[21px] text-[#A3A6AE]">{{ $article->author->name }} - {{ $article->created_at->format('M d, Y') }}</p>
						</div>
					</div>
				</a>
        @empty
          <p>Belum ada artikel dengan keyword yang kamu cari</p>
        @endforelse
			
		
			</div>
		</section>

	</body>
	
@endsection
