@push('after-styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&display=swap" rel="stylesheet">
<!-- CSS -->
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />
<link href="{{ asset('main.css') }}" rel="stylesheet" />

@endpush
@extends('front.master')
@section('content')

<body class="font-[Poppins]">
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
	<header class="flex flex-col items-center gap-[50px] mt-[50px]">
		<div id="Headline" class="max-w-[1130px] mx-auto flex flex-col gap-4 items-start">
		
			<h1 id="Title" class="font-bold text-[46px] leading-[60px] text-start ">
        {{ $articleNews->name }}
      </h1>
			<div class="flex mt-5 gap-[70px]">
				<a id="Author" href="{{ route('front.author',$articleNews->author->slug) }}" class="w-fit h-fit">
					<div class="flex items-center gap-3">
						<div class="w-14 h-14 rounded-full overflow-hidden">
							<img src="{{ Storage::url($articleNews->author->avatar) }}" class="object-cover w-full h-full" alt="avatar">
						</div>
						<div class="flex flex-col gap-1">
							<p class="font-semibold text-lg leading-[21px]">{{ $articleNews->author->name }}</p>
							<p class="text-sm leading-[18px] text-[#A3A6AE]">{{ $articleNews->author->occupation }}</p>
						</div>
					</div>
				</a>
				{{-- <div id="Rating" class="flex items-center gap-1">
					<div class="flex items-center">
							<p class="w-fit text-[#A3A6AE]">{{ $articleNews->created_at->format('M d, Y') }} - {{ $articleNews->category->name }}</p>
					</div>
					<p class="font-semibold text-xs leading-[18px]">(12,490)</p>
				</div> --}}
			</div>
		</div>
		<div class="w-[1150px] h-[500px] flex shrink-0 ">
			<img src="{{ Storage::url($articleNews->thumbnail) }}" class="object-center w-full h-full rounded-2xl" alt="cover thumbnail">
		</div>
	
		
	</header>
	<section id="Article-container" class="max-w-[1130px] mx-auto flex gap-20 mt-[50px]">
		<article class="overflow-hidden" id="Content-wrapper">
		  {!! $articleNews->content !!}
		</article>
		<div class="side-bar flex flex-col w-[300px] shrink-0 gap-10">
			<div class="ads flex flex-col gap-3 w-full">
				<a href="{{ $squareAds_1->link }}">
					<img src="{{ Storage::url($squareAds_1->thumbnail) }}" class="object-contain w-full h-full" alt="ads" />
				</a>
				<p class="font-medium text-sm leading-[21px] text-[#A3A6AE] flex gap-1">
					Our Advertisement <a href="#" class="w-[18px] h-[18px]"><img
							src="{{ asset('assets/images/icons/message-question.svg') }}" alt="icon" /></a>
				</p>
			</div>
			<div id="More-from-author" class="flex flex-col gap-4">
				<p class="font-bold">More From Author</p>
				@forelse ($author_news as $news )
				<a href="{{ route('front.details',$news->slug) }}" class="card-from-author">
					<div
						class="rounded-[20px] ring-1 ring-[#EEF0F7] p-[14px] flex gap-4 hover:ring-2 hover:ring-[#FF6B18] transition-all duration-300">
						<div class="w-[70px] h-[70px] flex shrink-0 overflow-hidden rounded-2xl">
							<img src="{{ Storage::url($news->thumbnail) }}" class="object-cover w-full h-full"
								alt="thumbnail">
						</div>
						<div class="flex flex-col gap-[6px]">
							<p class="line-clamp-2 font-bold">{{ Str::limit($news->name,40) }}</p>
							<p class="text-xs leading-[18px] text-[#A3A6AE]">{{ $news->author->name }} - {{ $news->created_at->format('M d, Y') }}</p>
						</div>
					</div>
				</a>
				@empty
					<p>Penulis belum memiliki Artikel lain</p>
				@endforelse
				
			</div>
			<div class="ads flex flex-col gap-3 w-full">
				<a href="{{ $squareAds_2->link }}">
					<img src="{{ Storage::url($squareAds_2->thumbnail) }}" class="object-contain w-full h-full" alt="ads" />
				</a>
				<p class="font-medium text-sm leading-[21px] text-[#A3A6AE] flex gap-1">
					Our Advertisement <a href="#" class="w-[18px] h-[18px]"><img
							src="{{ asset('assets/images/icons/message-question.svg') }}" alt="icon" /></a>
				</p>
			</div>
		</div>
	</section>
	<section id="Advertisement" class="max-w-[1130px] mx-auto flex justify-center mt-[70px]">
		<div class="flex flex-col gap-3 shrink-0 w-fit">
			<a href="{{ $bannerAds->link }}">
				<div class="w-[900px] h-[120px] flex shrink-0 border border-[#EEF0F7] rounded-2xl overflow-hidden">
					<img src="{{ Storage::url($bannerAds->thumbnail) }}" class="object-cover w-full h-full" alt="ads" />
				</div>
			</a>
			<p class="font-medium text-sm leading-[21px] text-[#A3A6AE] flex gap-1">
				Our Advertisement
         <a href="#" class="w-[18px] h-[18px]"><img
						src="{{ asset('assets/images/icons/message-question.svg') }}" alt="icon" />
          </a>
			</p>
		</div>
	</section>
	<section id="Up-to-date" class="w-full flex justify-center mt-[70px] py-[50px] bg-[#F9F9FC]">
		<div class="max-w-[1130px] mx-auto flex flex-col gap-[30px]">
			<div class="flex justify-between items-center">
				<h2 class="font-bold text-[26px] leading-[39px]">
					Other News You <br />
					Might Be Interested
				</h2>
			</div>
			<div class="grid grid-cols-3 gap-[30px]">
        @forelse($articles as $article)
        <a href="{{ route('front.details',$article->slug) }}" class="card-news">
					<div
						class="rounded-[20px] ring-1 ring-[#EEF0F7] p-[26px_20px] flex flex-col gap-4 hover:ring-2 hover:ring-[#FF6B18] transition-all duration-300 bg-white">
						<div
							class="thumbnail-container w-full h-[200px] rounded-[20px] flex shrink-0 overflow-hidden relative">
							<p
								class="badge-white absolute top-5 left-5 rounded-full p-[8px_18px] bg-white font-bold text-xs leading-[18px] uppercase">
								{{ $article->category->name }}</p>
							<img src="{{ Storage::url($article->thumbnail) }}" class="object-cover w-full h-full"
								alt="thumbnail" />
						</div>
						<div class="card-info flex flex-col gap-[6px]">
							<h3 class="font-bold text-lg leading-[27px]">
                {{ Str::limit($article->name,57) }}
              </h3>
							<p class="text-sm leading-[21px] text-[#A3A6AE]">{{ $article->author->name }} - {{ $article->created_at->format('M d, Y') }}</p>
						</div>
					</div>
				</a>
        @empty
          Belum ada artikel lainnya
        @endforelse
			
			
			</div>
		</div>
	</section>

	
</body>
<x-footer/>

@endsection

@push('after-scripts')
<script src="js/two-lines-text.js"></script>
<script src="{{ asset('customjs/sliderCategory.js') }}"></script>
@endpush