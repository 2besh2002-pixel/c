<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>إنشاء عقد | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        input[type="date"],
        .en-numbers,
        .date-input {
            direction: ltr !important;
            text-align: center;
            font-variant-numeric: tabular-nums;
            font-feature-settings: "numr" 0, "tnum" 1;
        }

        input[type="date"] {
            -webkit-locale: "en-US";
            calendar: gregory;
        }

        input[type="date"]::-webkit-datetime-edit {
            direction: ltr !important;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            cursor: pointer;
        }
    </style>
</head>

<body class="min-h-screen bg-emerald-50/40 font-sans text-emerald-950">
    <main class="mx-auto w-full max-w-7xl space-y-5 px-4 py-5 sm:px-6 lg:px-8">

        <!-- Header & Contract Details Section -->
        <section class="overflow-hidden rounded-2xl border border-emerald-200 bg-white shadow-sm">
            <header
                class="border-b border-emerald-100 bg-gradient-to-br from-white via-emerald-50/30 to-emerald-100/30 px-4 py-4 sm:px-6 sm:py-5">
                <div class="flex flex-col-reverse items-stretch justify-end gap-4 md:flex-row md:justify-between">
                    <!-- Logo -->
                    <div class="flex h-16 w-36 shrink-0 items-center justify-center sm:h-20 sm:w-48">
                        <img class="h-full w-36 object-contain" src="{{ asset('images/new-logo1.png') }}"
                            alt="أمر تم">
                    </div>

                    <!-- Contract Details Box -->
                    <div
                        class="flex w-full justify-center items-center rounded-xl border border-emerald-200 bg-emerald-50/60 p-2.5 shadow-sm sm:gap-2.5 sm:p-3 md:h-full">
                        <div class="flex justify-center align-center flex-wrap items-center gap-5">
                            <div class="flex flex-col gap-1">
                                <span class="text-[11px] font-bold text-emerald-700 whitespace-nowrap">نوع العقد</span>
                                <select id="contract_type_id" name="contract_type_id"
                                    class="w-24 sm:w-28 rounded-lg border border-emerald-200 bg-white px-2 py-1.5 text-xs font-semibold text-emerald-950 outline-none transition focus:border-emerald-500 focus:ring-1 focus:ring-emerald-400">
                                    <option value="1" data-price="5000">سنوي</option>
                                </select>
                            </div>

                            <div class="flex flex-col gap-1">
                                <span class="text-[11px] font-bold text-emerald-700 whitespace-nowrap">المدة
                                    (السنوات)</span>
                                <input id="duration_years" name="duration_years" type="number" value="1"
                                    min="1" readonly lang="en-US" dir="ltr"
                                    class="en-numbers w-16 sm:w-20 rounded-lg border border-emerald-200 bg-emerald-100/70 px-2 py-1.5 text-center text-xs font-extrabold text-emerald-900 outline-none [direction:ltr]">
                            </div>

                            <div class="flex flex-col gap-1">
                                <span class="text-[11px] font-bold text-emerald-700 whitespace-nowrap">بداية
                                    العقد</span>
                                <input id="start_date" name="start_date" type="date" lang="en-US" dir="ltr"
                                    data-calendar="gregory" value="2026-09-01" required
                                    class="date-input en-numbers w-32 sm:w-34 rounded-lg border border-emerald-200 bg-white px-2 py-1.5 text-center text-xs font-semibold text-emerald-950 outline-none transition focus:border-emerald-500 focus:ring-1 focus:ring-emerald-400 [direction:ltr]">
                            </div>

                            <div class="flex flex-col gap-1">
                                <span class="text-[11px] font-bold text-emerald-700 whitespace-nowrap">نهاية
                                    العقد</span>
                                <input id="end_date" name="end_date" type="date" lang="en-US" dir="ltr"
                                    data-calendar="gregory" value="2027-09-01" required
                                    class="date-input en-numbers w-32 sm:w-34 rounded-lg border border-emerald-200 bg-white px-2 py-1.5 text-center text-xs font-semibold text-emerald-950 outline-none transition focus:border-emerald-500 focus:ring-1 focus:ring-emerald-400 [direction:ltr]">
                            </div>

                            <div class="flex flex-col gap-1">
                                <span class="text-[11px] font-bold text-emerald-700 whitespace-nowrap">رقم العقد</span>
                                <input id="contract_number" type="text" lang="en-US" dir="ltr"
                                    value="CNT-0001" readonly
                                    class="en-numbers w-28 sm:w-32 rounded-lg border border-emerald-200 bg-emerald-100/70 px-2 py-1.5 text-center text-xs font-extrabold text-emerald-900 outline-none [direction:ltr]">
                            </div>
                        </div>
                    </div>

                </div>
            </header>
        </section>

        <!-- Contract Main Banner & Parties Section -->
        <section class="overflow-hidden rounded-2xl border border-emerald-200 bg-white shadow-sm">
            <header
                class="flex items-center justify-center border-b border-emerald-900 bg-gradient-to-r from-emerald-950 via-emerald-900 to-emerald-800 px-5 py-4 sm:px-7">
                <div>
                    <h2 class="text-xl font-extrabold text-white">عقد <span id="contract_type_display">سنوي</span>
                        إلكتروني</h2>
                </div>
            </header>

            <div class="bg-emerald-50/50 p-5 sm:p-7">
                <div class="grid gap-5 lg:grid-cols-2">
                    <div class="overflow-hidden rounded-xl border border-emerald-200 bg-white shadow-sm">
                        <div
                            class="flex items-center justify-center border-b border-emerald-900 bg-gradient-to-r from-emerald-900 to-emerald-800 px-5 py-3.5">
                            <h3 class="text-base font-extrabold text-white">الطرف الأول</h3>
                        </div>
                        <dl class="divide-y divide-emerald-100 text-sm">
                            <div class="grid grid-cols-3 gap-3 px-4 py-3.5 sm:px-5">
                                <dt class="font-bold text-emerald-700">اسم المنشأة</dt>
                                <dd class="col-span-2 wrap-break-word font-semibold text-emerald-950">مؤسسة آمر تم
                                    لخدمات الأعمال</dd>
                            </div>
                            <div class="grid grid-cols-3 gap-3 px-4 py-3.5 sm:px-5">
                                <dt class="font-bold text-emerald-700">الرقم الوطني الموحد</dt>
                                <dd class="col-span-2 wrap-break-word font-semibold text-emerald-950">7036125610</dd>
                            </div>
                            <div class="grid grid-cols-3 gap-3 px-4 py-3.5 sm:px-5">
                                <dt class="font-bold text-emerald-700">العنوان</dt>
                                <dd class="col-span-2 wrap-break-word font-semibold text-emerald-950">جدة، حي الحمراء،
                                    شارع فلسطين، مركز الجمجوم التجاري</dd>
                            </div>
                            <div class="grid grid-cols-3 gap-3 px-4 py-3.5 sm:px-5">
                                <dt class="font-bold text-emerald-700">البريد الإلكتروني</dt>
                                <dd class="col-span-2 wrap-break-word font-semibold text-emerald-950">info@amrtm.com.sa
                                </dd>
                            </div>
                            <div class="grid grid-cols-3 gap-3 px-4 py-3.5 sm:px-5">
                                <dt class="font-bold text-emerald-700">رقم الجوال</dt>
                                <dd class="col-span-2 wrap-break-word font-semibold text-emerald-950">7036125610</dd>
                            </div>
                            <div class="grid grid-cols-3 gap-3 px-4 py-3.5 sm:px-5">
                                <dt class="font-bold text-emerald-700">ويمثلها المدير العام</dt>
                                <dd class="col-span-2 wrap-break-word font-semibold text-emerald-950">صالح بن ناصر
                                    الشمراني</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="overflow-hidden rounded-xl border border-emerald-200 bg-white shadow-sm">
                        <div
                            class="flex items-center justify-center border-b border-emerald-900 bg-gradient-to-r from-emerald-900 to-emerald-800 px-5 py-3.5">
                            <h3 class="text-base font-extrabold text-white">الطرف الثاني</h3>
                        </div>
                        <dl class="divide-y divide-emerald-100 text-sm">
                            <div class="grid grid-cols-3 gap-3 px-4 py-3.5 sm:px-5">
                                <dt class="font-bold text-emerald-700">اسم المنشأة</dt>
                                <dd class="col-span-2 wrap-break-word font-semibold text-emerald-950">مؤسسة 1</dd>
                            </div>
                            <div class="grid grid-cols-3 gap-3 px-4 py-3.5 sm:px-5">
                                <dt class="font-bold text-emerald-700">الرقم الوطني الموحد</dt>
                                <dd class="col-span-2 wrap-break-word font-semibold text-emerald-950">4XXXXXXXXXXXXX
                                </dd>
                            </div>
                            <div class="grid grid-cols-3 gap-3 px-4 py-3.5 sm:px-5">
                                <dt class="font-bold text-emerald-700">العنوان</dt>
                                <dd class="col-span-2 wrap-break-word font-semibold text-emerald-950">جدة، حي الحمراء，
                                    شارع فلسطين 2724، الرمز 23321</dd>
                            </div>
                            <div class="grid grid-cols-3 gap-3 px-4 py-3.5 sm:px-5">
                                <dt class="font-bold text-emerald-700">البريد الإلكتروني</dt>
                                <dd class="col-span-2 wrap-break-word font-semibold text-emerald-950">
                                    ceo@XXXXXXXXXXX.com</dd>
                            </div>
                            <div class="grid grid-cols-3 gap-3 px-4 py-3.5 sm:px-5">
                                <dt class="font-bold text-emerald-700">رقم الجوال</dt>
                                <dd class="col-span-2 wrap-break-word font-semibold text-emerald-950">05XXXXXXXX</dd>
                            </div>
                            <div class="grid grid-cols-3 gap-3 px-4 py-3.5 sm:px-5">
                                <dt class="font-bold text-emerald-700">ويمثلها المدير العام</dt>
                                <dd class="col-span-2 wrap-break-word font-semibold text-emerald-950"> خالد عبد الله
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </section>

        <!-- Clauses Section -->
        <section class="rounded-2xl border border-emerald-200 bg-white p-5 shadow-sm sm:p-7">
            <div id="clausesContainer" class="space-y-3">

                <article class="flex rounded-xl p-2">
                    <div class="min-w-0 flex-1">
                        <h2 class="text-2xl font-black leading-tight text-emerald-950">
                            التمهيد
                        </h2>
                        <p class="mt-2 text-sm leading-7 text-emerald-800">
                            نظرًا لرغبة الطرف الثاني في الاستفادة من خبرات وخدمات الطرف الأول، وحرصًا من الطرفين على
                            تنظيم العلاقة بينهما بما يحقق المصالح المشتركة، فقد اتفق الطرفان على أن يتولى الطرف الأول
                            تقديم الخدمات التجارية والإنجازات الإدارية للطرف الثاني لدى الجهات الحكومية والجهات الشريكة
                            ذات العلاقة، وذلك وفقًا لأحكام هذا العقد وشروطه.
                            ويُعد هذا التمهيد جزءًا لا يتجزأ من العقد ومكمّلًا لأحكامه.
                        </p>
                    </div>
                </article>

                @php
                    $clauses = [
                        [
                            'title' => 'غرض العقد',
                            'body' =>
                                'يلتزم الطرف الأول بتنفيذ الخدمات التالية للطرف الثاني، على سبيل المثال لا الحصر:',
                            'list' => [
                                'متابعة وإنجاز المعاملات لدى الجهات الحكومية ذات العلاقة.',
                                'التنسيق مع الجهات الشريكة والمعنية والمتصلة بأنشطة الطرف الثاني.',
                                'إعداد وتجهيز الوثائق والمتطلبات الرسمية المرتبطة بالمعاملات.',
                                'الاستعانة بالمختصين لتقديم الاستشارات التجارية والإدارية بما يخدم مصالح الطرف الثاني.',
                                'أي خدمات إضافية يتفق عليها كتابيًا بين الطرفين.',
                            ],
                        ],
                        [
                            'title' => 'مدة العقد',
                            'body' =>
                                'مدة هذا العقد سنة واحدة، تبدأ من تاريخ 1/1/202__م وتنتهي في 31/12/202__م، ويجوز للطرفين تمديد العقد أو تعديله أو إنهاؤه بموجب اتفاق مكتوب بينهما عند حدوث ما يقتضي ذلك.',
                        ],
                        [
                            'title' => 'التزامات الطرف الثاني',
                            'body' => null,
                            'subsections' => [
                                [
                                    'sub' => '1. تسليم المستندات',
                                    'text' =>
                                        'يلتزم الطرف الثاني بتسليم الطرف الأول جميع المستندات والبيانات والمعلومات المطلوبة لإنجاز المهام والخدمات المتفق عليها، وذلك لتمكين الطرف الأول من تنفيذ الأعمال الموكلة إليه.',
                                ],
                                [
                                    'sub' => '2. توفير المستندات الإضافية',
                                    'text' =>
                                        'يلتزم الطرف الثاني بتقديم أي وثائق أو مستندات إضافية يطلبها الطرف الأول فيما يخص إنجاز المهام الموكلة إليه، متى كانت تلك المستندات لازمة أو مطلوبة لإتمام الإجراءات لدى الجهات الحكومية أو الجهات الأخرى ذات العلاقة.',
                                ],
                                [
                                    'sub' => '3. سداد الرسوم',
                                    'text' =>
                                        'يلتزم الطرف الثاني بسداد جميع الرسوم الحكومية أو رسوم الجهات ذات العلاقة المطلوبة لإتمام أي إجراء، وذلك خلال المواعيد النظامية المحددة، ما لم يتم الاتفاق كتابيًا على خلاف ذلك.',
                                ],
                            ],
                        ],
                        [
                            'title' => 'التزامات الطرف الأول',
                            'body' => null,
                            'list' => [
                                'تتولى مؤسسة آمر تم لخدمات الأعمال تنفيذ جميع المهام والخدمات الموكلة إليها وفقًا لأحكام هذا العقد.',
                                'يلتزم الطرف الأول بإتمام كافة الإجراءات النظامية المطلوبة خلال المدد المتفق عليها مع الطرف الثاني، وبذل العناية المهنية اللازمة في تنفيذ الخدمات.',
                                'يلتزم الطرف الأول بتقديم الأعمال والخدمات بذمة ومهنية، والمحافظة على سرية المعلومات والوثائق الخاصة بالطرف الثاني وعدم استخدامها إلا في حدود تنفيذ الخدمات محل العقد.',
                            ],
                        ],
                        [
                            'title' => 'المراسلات',
                            'body' =>
                                'تتم جميع المراسلات بين الطرفين عبر البريد الإلكتروني والأرقام المعتمدة من قبلهما، وتُعد الرسائل النصية والمراسلات عبر تطبيق واتساب من المراسلات الرسمية والملزمة للطرفين من تاريخ إرسالها، وتكون لها حجية قانونية معتبرة في حدود ما يسمح به النظام.',
                        ],
                        [
                            'title' => 'حل النزاعات',
                            'body' =>
                                'في حال حدوث أي خلاف – لا سمح الله – يتعلق بتنفيذ أو تفسير هذا العقد، يسعى الطرفان أولًا إلى حله وديًا خلال مدة مناسبة، وفي حال تعذر الوصول إلى حل ودي، يُحال النزاع إلى الجهة القضائية المختصة في محافظة جدة، المملكة العربية السعودية.',
                        ],
                        [
                            'title' => 'القوة القاهرة',
                            'body' => null,
                            'list' => [
                                'لا يُعد أي من الطرفين مُخلًا بالتزاماته التعاقدية إذا أعاق تنفيذها ظرف طارئ أو قوة قاهرة خارجة عن إرادته، مثل الكوارث الطبيعية، والحرائق، والفيضانات، والجوائح، والقرارات الحكومية، أو أي أحداث استثنائية غير متوقعة.',
                                'يلتزم الطرف المتأثر بالقوة القاهرة بإخطار الطرف الآخر كتابيًا فور وقوع الحالة، مع بيان طبيعتها وتأثيرها المتوقع على تنفيذ الالتزامات، متى أمكن ذلك.',
                                'إذا استمرت حالة القوة القاهرة لمدة تتجاوز (60) ستين يومًا متواصلة، جاز لأي من الطرفين إنهاء العقد بإشعار كتابي للطرف الآخر، دون أن يترتب على ذلك أي تعويض، مع حفظ الحقوق والالتزامات المستحقة قبل وقوع حالة القوة القاهرة.',
                            ],
                        ],
                        [
                            'title' => 'المدفوعات',
                            'body' => null,
                            'list' => [
                                'يلتزم الطرف الثاني بسداد قيمة هذا العقد، والبالغة (60,000) ستون ألف ريال سعودي سنويًا، شاملة ضريبة القيمة المضافة وفقًا للأنظمة المعمول بها.',
                                'يتقاضى الطرف الأول القيمة المشار إليها في الفقرة السابقة على أربع دفعات سنوية ربع سنوية، بواقع (15,000) خمسة عشر ألف ريال سعودي لكل دفعة، تُستحق كل ثلاثة أشهر.',
                                'يتم تحويل الدفعات المستحقة إلى الحساب البنكي المعتمد للطرف الأول، وفق البيانات التالية:',
                            ],
                            'bank' => [
                                'اسم المستفيد: صالح الناصر',
                                'رقم الحساب: XXXXXXXXXXXXXXXXXXXXXX',
                                'البنك: البنك الأهلي السعودي',
                                'رقم الآيبان (IBAN): SAXXXXXXXXXXXXXXXXXXXXXXX',
                            ],
                        ],
                    ];
                @endphp

                @foreach ($clauses as $index => $clause)
                    <article
                        class="flex gap-4 rounded-xl border border-emerald-200 border-r-4 border-r-emerald-700 bg-emerald-50/50 p-4 sm:p-5 transition hover:bg-emerald-100/50">
                        <span
                            class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-emerald-100 text-sm font-black text-emerald-900 shadow-sm">{{ $index + 1 }}</span>
                        <div class="min-w-0 flex-1">
                            <h2 class="mb-2 text-lg font-extrabold text-emerald-900">{{ $clause['title'] }}</h2>

                            @if (!empty($clause['body']))
                                <p class="whitespace-pre-line text-sm leading-7 text-emerald-800">{{ $clause['body'] }}
                                </p>
                            @endif

                            @if (!empty($clause['list']))
                                <ol
                                    class="mt-2 list-inside list-decimal space-y-1.5 text-sm leading-7 text-emerald-800">
                                    @foreach ($clause['list'] as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ol>
                            @endif

                            @if (!empty($clause['subsections']))
                                <div class="mt-2 space-y-3">
                                    @foreach ($clause['subsections'] as $sub)
                                        <div>
                                            <h3 class="text-sm font-extrabold text-emerald-900">{{ $sub['sub'] }}
                                            </h3>
                                            <p class="mt-1 whitespace-pre-line text-sm leading-7 text-emerald-800">
                                                {{ $sub['text'] }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if (!empty($clause['bank']))
                                <div
                                    class="mt-3 overflow-hidden rounded-xl border border-emerald-300 bg-emerald-100/70">
                                    <table class="w-full text-right text-sm">
                                        <tbody class="divide-y divide-emerald-200">
                                            @foreach ($clause['bank'] as $line)
                                                <tr>
                                                    @php $parts = explode(': ', $line, 2); @endphp
                                                    <td class="w-40 px-4 py-2.5 font-extrabold text-emerald-900">
                                                        {{ $parts[0] }}</td>
                                                    <td class="px-4 py-2.5 font-semibold text-emerald-950"
                                                        dir="ltr">{{ $parts[1] ?? '' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <!-- Summary & Signature Section -->
        <section class="rounded-2xl border border-emerald-200 bg-white p-5 shadow-sm sm:p-7">
            <div
                class="mb-5 flex items-center gap-2 rounded-xl border border-emerald-200 bg-emerald-100/70 px-4 py-3 text-sm font-bold text-emerald-900">
                <span
                    class="grid h-5 w-5 place-items-center rounded-full bg-emerald-700 text-xs font-bold text-white">i</span>
                <span>تفاصيل العقد المختار وحالة التوقيع الحالية</span>
            </div>
            <div class="grid gap-5 lg:grid-cols-2">
                <div class="rounded-xl border border-emerald-200 bg-emerald-50/50 p-5 shadow-sm">
                    <h2 class="mb-4 font-extrabold text-emerald-900">بيانات العميل</h2>
                    <dl class="space-y-3 text-sm">
                        <div class="flex justify-between gap-4">
                            <dt class="font-bold text-emerald-700">الاسم</dt>
                            <dd class="font-semibold text-emerald-950">خالد عبد الله </dd>
                        </div>
                        <div class="flex justify-between gap-4">
                            <dt class="font-bold text-emerald-700">رقم الجوال</dt>
                            <dd class="font-semibold text-emerald-950">05XXXXXXXX</dd>
                        </div>
                    </dl>
                </div>
                <div class="rounded-xl border border-emerald-200 bg-emerald-50/50 p-5 shadow-sm">
                    <h2 class="mb-4 font-extrabold text-emerald-900">بيانات العقد</h2>
                    <dl class="space-y-3 text-sm">
                        <div class="flex justify-between gap-4">
                            <dt class="font-bold text-emerald-700">رقم العقد</dt>
                            <dd class="en-numbers font-semibold text-emerald-950" dir="ltr">CNT-0001</dd>
                        </div>
                        <div class="flex justify-between gap-4">
                            <dt class="font-bold text-emerald-700">تاريخ الإنشاء</dt>
                            <dd class="en-numbers font-semibold text-emerald-950" dir="ltr">2026-09-01</dd>
                        </div>
                    </dl>
                </div>
            </div>
            <div class="mt-5 grid gap-4 sm:grid-cols-2">
                <div class="rounded-xl border border-emerald-200 bg-white p-4">
                    <p class="mb-2 text-xs font-bold text-emerald-700">حالة العقد</p>
                    <span
                        class="inline-block rounded-full bg-emerald-100 px-3 py-1 text-xs font-extrabold text-emerald-900">بانتظار
                        التوقيع</span>
                </div>
                <div class="rounded-xl border border-emerald-200 bg-white p-4">
                    <p class="mb-2 text-xs font-bold text-emerald-700">حالة الدفع</p>
                    <span
                        class="inline-block rounded-full bg-emerald-100 px-3 py-1 text-xs font-extrabold text-emerald-900">لم
                        يتم
                        الدفع</span>
                </div>
            </div>
            <div class="flex flex-row justify-between">
                <label class="mt-7 flex cursor-pointer items-center gap-2.5 text-sm font-bold text-emerald-900">
                    <input id="termsAccepted" type="checkbox" required
                        class="h-5 w-5 rounded border-emerald-300 text-emerald-700 focus:ring-emerald-500 accent-emerald-700">
                    <span>أوافق على <a href="#" class="text-emerald-700 underline hover:text-emerald-950">الشروط
                            والأحكام</a> وأقر بصحة البيانات المدخلة</span>
                </label>
                <a href="{{ route('amrtm.index') }}"
                    class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-emerald-900 px-5 py-3.5 text-base font-extrabold text-white shadow-lg shadow-emerald-900/20 transition-all hover:bg-emerald-950 hover:shadow-xl sm:w-auto sm:min-w-56">
                    التوقيع
                </a>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const startDate = document.getElementById('start_date');
            const endDate = document.getElementById('end_date');
            const contractType = document.getElementById('contract_type_id');
            const contractTypeDisplay = document.getElementById('contract_type_display');
            const tableBody = document.getElementById('attachmentsTableBody');

            const toEnglishDigits = (str) => {
                if (!str) return str;
                const easternArabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩', '۰', '۱', '۲', '۳',
                    '۴', '۵', '۶', '۷', '۸', '۹'
                ];
                const westernArabic = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3',
                    '4', '5', '6', '7', '8', '9'
                ];
                return str.replace(/[٠-٩۰-۹]/g, d => westernArabic[easternArabic.indexOf(d)]);
            };

            const updateEndDate = () => {
                if (!startDate.value) return;
                const normalizedStart = toEnglishDigits(startDate.value);
                const date = new Date(normalizedStart + 'T00:00:00');
                if (!isNaN(date.getTime())) {
                    date.setFullYear(date.getFullYear() + 1);
                    endDate.value = date.toISOString().split('T')[0];
                }
            };

            startDate.addEventListener('input', (e) => {
                const val = toEnglishDigits(e.target.value);
                if (val !== e.target.value) {
                    e.target.value = val;
                }
            });

            endDate.addEventListener('input', (e) => {
                const val = toEnglishDigits(e.target.value);
                if (val !== e.target.value) {
                    e.target.value = val;
                }
            });

            const amountValueDisplay = document.querySelector('.amount-value');
            const updateContractType = () => {
                const option = contractType.options[contractType.selectedIndex];
                const rawPrice = Number(option?.dataset.price || 0);
                if (amountValueDisplay) {
                    amountValueDisplay.textContent = rawPrice.toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                }
                if (contractTypeDisplay && option) {
                    contractTypeDisplay.textContent = option.text.trim();
                }
            };
            startDate.addEventListener('change', updateEndDate);
            contractType.addEventListener('change', updateContractType);
            updateContractType();
            document.querySelectorAll('.attachment-input').forEach(input => input.addEventListener('change', () => {
                const file = input.files[0];
                if (!file) return;
                document.getElementById('emptyAttachmentsRow')?.remove();
                input.parentElement.classList.add('border-emerald-700', 'bg-emerald-100/60');
                const hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'attachment_types[]';
                hidden.value = input.dataset.type;
                input.parentElement.appendChild(hidden);
                const row = document.createElement('tr');
                row.className = 'border-t border-emerald-200 bg-white';
                row.dataset.type = input.dataset.type;
                const todayFormatted = new Date().toISOString().split('T')[0];
                row.innerHTML =
                    `<td class="px-4 py-3 font-semibold text-emerald-950">${file.name}</td><td class="px-4 py-3 text-emerald-700">${input.parentElement.querySelector('span:nth-child(2)').textContent}</td><td class="en-numbers px-4 py-3 text-emerald-600" dir="ltr">${todayFormatted}</td><td class="en-numbers px-4 py-3 font-bold text-emerald-900" dir="ltr">${(file.size / 1024 / 1024).toFixed(2)} MB</td><td class="px-4 py-3"><button type="button" class="remove-file font-bold text-red-600 hover:text-red-800 transition">حذف</button></td>`;
                tableBody.appendChild(row);
                row.querySelector('.remove-file').addEventListener('click', () => {
                    input.value = '';
                    hidden.remove();
                    row.remove();
                    input.parentElement.classList.remove('border-emerald-700',
                        'bg-emerald-100/60');
                    if (!tableBody.children.length) tableBody.innerHTML =
                        '<tr id="emptyAttachmentsRow"><td colspan="5" class="px-4 py-7 text-center font-semibold text-emerald-600">لا توجد ملفات مرفوعة</td></tr>';
                });
            }));
        });
    </script>
</body>

</html>
