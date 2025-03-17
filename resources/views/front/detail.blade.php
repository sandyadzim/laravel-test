<x-front-layout>
    <!-- Main Content -->
    <section class="bg-darkGrey relative py-[70px]">
        <div class="container">
            <!-- Breadcrumb -->
            <ul class="flex items-center gap-5 mb-[50px]">
                <li
                    class="text-secondary font-normal text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-5">
                    <a href="{{ route('front.index') }}">Home</a>
                </li>
                <li
                    class="text-secondary font-normal text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-5">
                    <a href="#!">
                        {{ $item->brand->name }}
                    </a>
                </li>
                <li
                    class="text-dark font-semibold text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-5">
                    {{ $item->name }}
                </li>
            </ul>

            <div class="grid grid-cols-12 gap-[30px]">
                <!-- Car Preview -->
                <div class="col-span-12 lg:col-span-8">
                    <div class="bg-white p-4 rounded-[30px] flex flex-col gap-4" id="gallery">
                        @php
                            $thumbnails = json_decode($item->photos, true);
                        @endphp
                        <img id="mainImage" src="{{ Storage::url($thumbnails[0]) }}"
                            class="md:h-[490px] rounded-[18px] h-auto w-full" alt="">
                        <div class="grid items-center grid-cols-4 gap-3 md:gap-5">
                            @foreach ($thumbnails as $index => $thumbnail)
                                <div>
                                    <button type="button"
                                        onclick="changeActive('{{ Storage::url($thumbnail) }}', {{ $index }})"
                                        class="contents">
                                        <img src="{{ Storage::url($thumbnail) }}" alt=""
                                            class="thumbnail {{ $index == 0 ? 'selected' : '' }}"
                                            id="thumbnail-{{ $index }}">
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Details -->
                <div class="col-span-12 md:col-start-5 lg:col-start-auto md:col-span-8 lg:col-span-4">
                    <div class="bg-white p-5 pb-[30px] rounded-3xl h-full">
                        <div class="flex flex-col h-full divide-y divide-grey">
                            <!-- Name, Category, Rating -->
                            <div class="max-w-[230px] pb-5">
                                <h1 class="font-bold text-[28px] leading-[42px] text-dark mb-[6px]">
                                    {{ $item->name }}
                                </h1>
                                <p class="text-secondary font-normal text-base mb-[10px]">
                                  {{ $item->brand->name }} - {{ $item->type->name }}
                                </p>
                                <div class="flex items-center gap-2">
                                    <span class="flex items-center gap-1">
                                        @for ($i = 0; $i < floor($item->star); $i++)
                                            <img src="/svgs/ic-star.svg" class="h-[22px] w-[22px]" alt="">
                                        @endfor
                                    </span>
                                    <p class="text-base font-semibold text-dark mt-[2px]">
                                        ({{ number_format($item->review, 0, ',', '.') }})
                                    </p>
                                </div>
                            </div>

                            <!-- Features -->
                            <ul class="flex flex-col gap-4 flex-start pt-5 pb-[25px]">
                                @php
                                    $features = explode(',', $item->features);
                                @endphp
                                @foreach ($features as $feature)
                                    <li class="flex items-center gap-3 text-base font-semibold text-dark">
                                        <img src="/svgs/ic-checkDark.svg" alt="">
                                        {{ $feature }}
                                    </li>
                                @endforeach
                            </ul>
                            <!-- Price, CTA Button -->
                            <div class="flex flex-col gap-4 pt-5 mt-auto">
                                <div>
                                    <p class="font-bold text-dark text-[22px]">
                                        Rp{{ number_format($item->price, 0, ',', '.') }}
                                        <span class="font-normal text-secondary">
                                            /day
                                        </span>
                                    </p>
                                </div>
                                <div class="w-full">
                                    <div class="p-1 rounded-full bg-primary group">
                                        <a href="#" class="btn-primary" />
                                        {{-- <a href="{{ route('front.checkout', $item->slug) }}" class="btn-primary"> --}}
                                        <p>
                                            Rent Now
                                        </p>
                                        <img src="/svgs/ic-arrow-right.svg" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="container relative py-[100px]">
        <header class="text-center mb-[50px]">
            <h2 class="font-bold text-dark text-[26px] mb-1">
                Frequently Asked Questions
            </h2>
            <p class="text-base text-secondary">Learn more about Vrom and get a success</p>
        </header>

        <!-- Questions -->
        <div class="grid md:grid-cols-2 gap-x-[50px] gap-y-6 max-w-[910px] w-full mx-auto">
            @foreach ($faqs as $faq)
                <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
                    id="faq{{ $loop->index + 1 }}">
                    <div class="flex items-center justify-between gap-1">
                        <p class="text-base font-semibold text-dark">
                            {{ $faq->name }}
                        </p>
                        <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
                    </div>
                    <div class="hidden pt-4 max-w-[335px]" id="faq{{ $loop->index + 1 }}-content">
                        <p class="text-base text-dark leading-[26px]">
                            {{ $faq->description }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Similar Cars -->
    <section class="bg-darkGrey">
        <div class="container relative py-[100px]">
            <header class="mb-[30px]">
                <h2 class="font-bold text-dark text-[26px] mb-1">
                    Similar Cars
                </h2>
                <p class="text-base text-secondary">Start your big day</p>
            </header>

            <!-- Cars -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-[29px]">
                @foreach ($similiarItems as $similiarItem)
                    <!-- Card -->
                    <div class="card-popular">
                        <div>
                            <h5 class="text-lg text-dark font-bold mb-[2px]">
                                {{ $similiarItem->name }}
                            </h5>
                            <p class="text-sm font-normal text-secondary">
                                {{ $similiarItem->type ? $similiarItem->type->name : '-' }}
                            </p>
                            <a href="{{ route('front.detail', $similiarItem->slug) }}" class="absolute inset-0"></a>
                        </div>
                        <img src="{{ $similiarItem->thumbnail }}" class="rounded-[18px] min-w-[216px] w-full h-[150px]"
                            alt="">
                        <div class="flex items-center justify-between gap-1">
                            <!-- Price -->
                            <p class="text-sm font-normal text-secondary">
                                <span
                                    class="text-base font-bold text-primary">Rp{{ number_format($similiarItem->price, 0, ',', '.') }}</span>/day
                            </p>
                            <!-- Rating -->
                            <p class="text-dark text-xs font-semibold flex items-center gap-[2px]">
                                ({{ $similiarItem->star }}/5)
                                <img src="/svgs/ic-star.svg" alt="">
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        function changeActive(url, index) {
            // Change the main image
            document.getElementById('mainImage').src = url;

            // Remove the selected class from all thumbnails
            document.querySelectorAll('.thumbnail').forEach(function(thumbnail) {
                thumbnail.classList.remove('selected');
            });

            // Add the selected class to the clicked thumbnail
            document.getElementById('thumbnail-' + index).classList.add('selected');
        }
    </script>
</x-front-layout>
