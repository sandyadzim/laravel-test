<x-front-layout>
    <!-- Main Content -->
    <section class="bg-darkGrey relative py-[70px]">
        <div class="container">
            <header class="mb-[30px]">
                <h2 class="font-bold text-dark text-[26px] mb-1">
                    Checkout & Drive Faster
                </h2>
                <p class="text-base text-secondary">We will help you get ready today</p>
            </header>

            <div class="flex items-center gap-5 lg:justify-between">
                <!-- Form Card -->
                <form action="{{ route('front.payment.update', $booking->id) }}" method="POST"
                    class="bg-white p-[30px] pb-10 rounded-3xl max-w-[490px] w-full" id="checkoutForm">
                    @csrf
                    @method('post')
                    <div class="flex flex-col gap-[30px]">
                        <div class="flex flex-col gap-4">
                            <h5 class="text-lg font-semibold">
                                Review Order
                            </h5>
                            <!-- Items -->
                            <div class="flex items-center justify-between">
                                <p class="text-base font-normal">
                                    Car choosen
                                </p>
                                <p class="text-base font-semibold">
                                    {{ $booking->item->brand->name }} - {{ $booking->item->name }}
                                </p>
                            </div>
                            <!-- Items -->
                            <div class="flex items-center justify-between">
                                <p class="text-base font-normal">
                                    Total day
                                </p>
                                <p class="text-base font-semibold">
                                    {{ $booking->start_date->diffInDays($booking->end_date) }} days
                                </p>
                            </div>
                            <!-- Items -->
                            <div class="flex items-center justify-between">
                                <p class="text-base font-normal">
                                    Service
                                </p>
                                <p class="text-base font-semibold">
                                    Delivery
                                </p>
                            </div>
                            <!-- Items -->
                            <div class="flex items-center justify-between">
                                <p class="text-base font-normal">
                                    Price
                                </p>
                                <p class="text-base font-semibold">
                                    Rp{{ number_format($booking->item->price, 0, ',', '.') }} per day
                                </p>
                            </div>
                            <!-- Items -->
                            <div class="flex items-center justify-between">
                                <p class="text-base font-normal">
                                    VAT (10%)
                                </p>
                                <p class="text-base font-semibold">
                                    Rp{{ number_format($booking->item->price * $booking->start_date->diffInDays($booking->end_date) * (10 / 100), 0, ',', '.') }}
                                </p>
                            </div>
                            <!-- Items -->
                            <div class="flex items-center justify-between">
                                <p class="text-base font-normal">
                                    Grand total
                                </p>
                                <p class="text-base font-semibold">
                                    Rp{{ number_format($booking->total_price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        {{-- <div class="flex flex-col gap-4">
                            <h5 class="text-lg font-semibold">
                                Payment Method
                            </h5>

                            <div class="relative boxPayment">
                                <div
                                    class="flex items-center justify-center gap-4 border border-primary rounded-[20px] p-5 min-h-[80px] cursor-pointer">
                                    <img src="/svgs/logo-midtrans.svg" alt="">
                                    <p class="text-base font-semibold">
                                        Midtrans
                                    </p>
                                </div>
                            </div>
                        </div> --}}
                        <!-- CTA Button -->
                        <div class="col-span-2 mt-5">
                            <!-- Button Primary -->
                            <div class="p-1 rounded-full bg-primary group">
                                <button class="btn-primary w-full flex" id="checkoutButton">
                                    <p>
                                        Continue
                                    </p>
                                    <img src="/svgs/ic-arrow-right.svg" alt="">
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <img src="/images/porsche_small.webp" class="max-w-[50%] hidden lg:block -mr-[200px]" alt="">
            </div>
        </div>
    </section>
</x-front-layout>
