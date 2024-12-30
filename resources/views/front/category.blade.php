@extends('front.master')
@section('content')
<body class="font-[Poppins] pb-[83px]">
	{{-- Navbar --}}
	<x-navbar/>
{{-- <nav id="Category" class="max-w-[1130px] mx-auto flex justify-center items-center gap-4 mt-[30px]">
    @foreach ($categories as $category_item)
    <a 
      href="{{ route('front.category', $category_item->slug) }}" 
      class="rounded-full p-[12px_22px] flex gap-[10px] font-semibold transition-all duration-300  hover:ring-2 hover:ring-[#FF6B18] {{ Request::is('category/' . $category_item->slug) ? 'border-4 border-[#FF6B18] ' : ' border border-[#EEF0F7] ' }}">
      <div class="w-6 h-6 flex shrink-0">
        <img src="{{ Storage::url($category_item->icon) }}" alt="icon" />
      </div>
      <span>{{ $category_item->name }}</span>
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
			@foreach ($categories as $category_item)
			<a 
				href="{{ route('front.category', $category_item->slug) }}" 
				class="rounded-full p-[12px_22px] flex gap-[10px] font-semibold transition-all duration-300 hover:ring-2 hover:ring-[#FF6B18] {{ Request::is('category/' . $category_item->slug) ? 'border-4 border-[#FF6B18]' : 'border border-[#EEF0F7]' }}">
				<div class="w-6 h-6 flex shrink-0">
					<img src="{{ Storage::url($category_item->icon) }}" alt="icon" />
				</div>
				<span>{{ $category_item->name }}</span>
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

	<section id="Category-result" class="max-w-[1130px] mx-auto flex items-center flex-col gap-[30px] mt-[70px]">
		<h1 class="text-4xl leading-[45px] font-bold text-center">
			Explore Our <br />
			{{ $category->name }} News
		</h1>
		<div id="search-cards" class="grid grid-cols-3 gap-[30px]">
      @forelse($category->news as $news)
      <a href="{{ route('front.details',$news->slug) }}" class="card">
				<div
					class="flex flex-col gap-4 p-[26px_20px] transition-all duration-300 ring-1 ring-[#EEF0F7] hover:ring-2 hover:ring-[#FF6B18] rounded-[20px] overflow-hidden bg-white">
					<div class="thumbnail-container h-[200px] relative rounded-[20px] overflow-hidden">
						{{-- <div
							class="badge absolute left-5 top-5 bottom-auto right-auto flex p-[8px_18px] bg-white rounded-[50px]">
							<p class="text-xs leading-[18px] font-bold">{{ $news->category->name }}</p>
						</div> --}}
						<img src="{{ Storage::url($news->thumbnail) }}" alt="thumbnail photo"
							class="w-full h-full object-cover" />
					</div>
					<div class="flex flex-col gap-[6px]">
						<h3 class="text-lg leading-[27px] font-bold">
							{{ Str::limit($news->name,57) }}
							{{-- {{ substr($news->name,0 , 61) }}{{ strlen($news->name) > 50 ? '...' : '' }} --}}
						</h3>
						<p class="text-sm leading-[21px] text-[#A3A6AE]">{{ $news->author->name }} - {{ $news->created_at->format('M d, Y') }}</p>
					</div>
				</div>
			</a>
      @empty
        <p>Belum ada berita terkait kategori berikut</p>
      @endforelse
			
		
		</div>
	</section>
	<section id="Advertisement" class="max-w-[1130px] mx-auto flex justify-center mt-[70px]">
		<div class="flex flex-col gap-3 shrink-0 w-fit">
			<a href="{{ $bannerAds->link }}">
				<div class="w-[900px] h-[120px] flex shrink-0 border border-[#EEF0F7] rounded-2xl overflow-hidden">
					<img src="{{Storage::url($bannerAds->thumbnail)}}" class="object-cover w-full h-full" alt="ads" />
				</div>
			</a>
			<p class="font-medium text-sm leading-[21px] text-[#A3A6AE] flex gap-1">
				Our Advertisement <a href="#" class="w-[18px] h-[18px]"><img
						src="{{asset('assets/images/icons/message-question.svg')}}" alt="icon" /></a>
			</p>
		</div>
	</section>
	<x-footer/>
</body>


@endsection