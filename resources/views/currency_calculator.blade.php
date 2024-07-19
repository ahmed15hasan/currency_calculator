<!-- resources/views/currency_calculator.blade.php -->

@extends('layouts.app') {{-- Use your existing layout or create a new one --}}

@section('content')
    <div class="container">
        <h2>Currency Calculator</h2>

        @if ($errors->any())
            <div id="errorAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form action="{{ route('currency.convert') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" name="currency_amount" id="amount" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="exampleSelect">From Currency:</label>
                <select class="selectpicker form-control" data-live-search="true" name="from_currency" id="exampleSelect" required>
                    <option value="">-Select From Currency-</option>
                    <option value="AUD" data-content='<span class="flag-icon flag-icon-au"></span> Australian Dollar (AUD)'>Australian Dollar (AUD)</option>
                    <option value="BGN" data-content='<span class="flag-icon flag-icon-bg"></span> Bulgarian Lev (BGN)'>Bulgarian Lev (BGN)</option>
                    <option value="BRL" data-content='<span class="flag-icon flag-icon-br"></span> Brazilian Real (BRL)'>Brazilian Real (BRL)</option>
                    <option value="CAD" data-content='<span class="flag-icon flag-icon-ca"></span> Canadian Dollar (CAD)'>Canadian Dollar (CAD)</option>
                    <option value="CHF" data-content='<span class="flag-icon flag-icon-ch"></span> Swiss Franc (CHF)'>Swiss Franc (CHF)</option>
                    <option value="CNY" data-content='<span class="flag-icon flag-icon-cn"></span> Chinese Yuan (CNY)'>Chinese Yuan (CNY)</option>
                    <option value="CZK" data-content='<span class="flag-icon flag-icon-cz"></span> Czech Koruna (CZK)'>Czech Koruna (CZK)</option>
                    <option value="DKK" data-content='<span class="flag-icon flag-icon-dk"></span> Danish Krone (DKK)'>Danish Krone (DKK)</option>
                    <option value="EUR" data-content='<span class="flag-icon flag-icon-eu"></span> Euro (EUR)'>Euro (EUR)</option>
                    <option value="GBP" data-content='<span class="flag-icon flag-icon-gb"></span> British Pound (GBP)'>British Pound (GBP)</option>
                    <option value="HKD" data-content='<span class="flag-icon flag-icon-hk"></span> Hong Kong Dollar (HKD)'>Hong Kong Dollar (HKD)</option>
                    <option value="HRK" data-content='<span class="flag-icon flag-icon-hr"></span> Croatian Kuna (HRK)'>Croatian Kuna (HRK)</option>
                    <option value="HUF" data-content='<span class="flag-icon flag-icon-hu"></span> Hungarian Forint (HUF)'>Hungarian Forint (HUF)</option>
                    <option value="IDR" data-content='<span class="flag-icon flag-icon-id"></span> Indonesian Rupiah (IDR)'>Indonesian Rupiah (IDR)</option>
                    <option value="ILS" data-content='<span class="flag-icon flag-icon-il"></span> Israeli Shekel (ILS)'>Israeli Shekel (ILS)</option>
                    <option value="INR" data-content='<span class="flag-icon flag-icon-in"></span> Indian Rupee (INR)'>Indian Rupee (INR)</option>
                    <option value="ISK" data-content='<span class="flag-icon flag-icon-is"></span> Icelandic Króna (ISK)'>Icelandic Króna (ISK)</option>
                    <option value="JPY" data-content='<span class="flag-icon flag-icon-jp"></span> Japanese Yen (JPY)'>Japanese Yen (JPY)</option>
                    <option value="KRW" data-content='<span class="flag-icon flag-icon-kr"></span> South Korean Won (KRW)'>South Korean Won (KRW)</option>
                    <option value="MXN" data-content='<span class="flag-icon flag-icon-mx"></span> Mexican Peso (MXN)'>Mexican Peso (MXN)</option>
                    <option value="MYR" data-content='<span class="flag-icon flag-icon-my"></span> Malaysian Ringgit (MYR)'>Malaysian Ringgit (MYR)</option>
                    <option value="NOK" data-content='<span class="flag-icon flag-icon-no"></span> Norwegian Krone (NOK)'>Norwegian Krone (NOK)</option>
                    <option value="NZD" data-content='<span class="flag-icon flag-icon-nz"></span> New Zealand Dollar (NZD)'>New Zealand Dollar (NZD)</option>
                    <option value="PHP" data-content='<span class="flag-icon flag-icon-ph"></span> Philippine Peso (PHP)'>Philippine Peso (PHP)</option>
                    <option value="PLN" data-content='<span class="flag-icon flag-icon-pl"></span> Polish Złoty (PLN)'>Polish Złoty (PLN)</option>
                    <option value="RON" data-content='<span class="flag-icon flag-icon-ro"></span> Romanian Leu (RON)'>Romanian Leu (RON)</option>
                    <option value="RUB" data-content='<span class="flag-icon flag-icon-ru"></span> Russian Ruble (RUB)'>Russian Ruble (RUB)</option>
                    <option value="SEK" data-content='<span class="flag-icon flag-icon-se"></span> Swedish Krona (SEK)'>Swedish Krona (SEK)</option>
                    <option value="SGD" data-content='<span class="flag-icon flag-icon-sg"></span> Singapore Dollar (SGD)'>Singapore Dollar (SGD)</option>
                    <option value="THB" data-content='<span class="flag-icon flag-icon-th"></span> Thai Baht (THB)'>Thai Baht (THB)</option>
                    <option value="TRY" data-content='<span class="flag-icon flag-icon-tr"></span> Turkish Lira (TRY)'>Turkish Lira (TRY)</option>
                    <option value="USD" data-content='<span class="flag-icon flag-icon-us"></span> US Dollar (USD)'>US Dollar (USD)</option>
                    <option value="ZAR" data-content='<span class="flag-icon flag-icon-za"></span> South African Rand (ZAR)'>South African Rand (ZAR)</option>
                </select>
            </div>
            <div class="form-group">
                <label for="to_currency">To Currency:</label>
                <select class="selectpicker form-control" data-live-search="true" name="to_currency" id="exampleSelect" required>
                    <option value="">-Select To Currency-</option>
                    <option value="AUD" data-content='<span class="flag-icon flag-icon-au"></span> Australian Dollar (AUD)'>Australian Dollar (AUD)</option>
                    <option value="BGN" data-content='<span class="flag-icon flag-icon-bg"></span> Bulgarian Lev (BGN)'>Bulgarian Lev (BGN)</option>
                    <option value="BRL" data-content='<span class="flag-icon flag-icon-br"></span> Brazilian Real (BRL)'>Brazilian Real (BRL)</option>
                    <option value="CAD" data-content='<span class="flag-icon flag-icon-ca"></span> Canadian Dollar (CAD)'>Canadian Dollar (CAD)</option>
                    <option value="CHF" data-content='<span class="flag-icon flag-icon-ch"></span> Swiss Franc (CHF)'>Swiss Franc (CHF)</option>
                    <option value="CNY" data-content='<span class="flag-icon flag-icon-cn"></span> Chinese Yuan (CNY)'>Chinese Yuan (CNY)</option>
                    <option value="CZK" data-content='<span class="flag-icon flag-icon-cz"></span> Czech Koruna (CZK)'>Czech Koruna (CZK)</option>
                    <option value="DKK" data-content='<span class="flag-icon flag-icon-dk"></span> Danish Krone (DKK)'>Danish Krone (DKK)</option>
                    <option value="EUR" data-content='<span class="flag-icon flag-icon-eu"></span> Euro (EUR)'>Euro (EUR)</option>
                    <option value="GBP" data-content='<span class="flag-icon flag-icon-gb"></span> British Pound (GBP)'>British Pound (GBP)</option>
                    <option value="HKD" data-content='<span class="flag-icon flag-icon-hk"></span> Hong Kong Dollar (HKD)'>Hong Kong Dollar (HKD)</option>
                    <option value="HRK" data-content='<span class="flag-icon flag-icon-hr"></span> Croatian Kuna (HRK)'>Croatian Kuna (HRK)</option>
                    <option value="HUF" data-content='<span class="flag-icon flag-icon-hu"></span> Hungarian Forint (HUF)'>Hungarian Forint (HUF)</option>
                    <option value="IDR" data-content='<span class="flag-icon flag-icon-id"></span> Indonesian Rupiah (IDR)'>Indonesian Rupiah (IDR)</option>
                    <option value="ILS" data-content='<span class="flag-icon flag-icon-il"></span> Israeli Shekel (ILS)'>Israeli Shekel (ILS)</option>
                    <option value="INR" data-content='<span class="flag-icon flag-icon-in"></span> Indian Rupee (INR)'>Indian Rupee (INR)</option>
                    <option value="ISK" data-content='<span class="flag-icon flag-icon-is"></span> Icelandic Króna (ISK)'>Icelandic Króna (ISK)</option>
                    <option value="JPY" data-content='<span class="flag-icon flag-icon-jp"></span> Japanese Yen (JPY)'>Japanese Yen (JPY)</option>
                    <option value="KRW" data-content='<span class="flag-icon flag-icon-kr"></span> South Korean Won (KRW)'>South Korean Won (KRW)</option>
                    <option value="MXN" data-content='<span class="flag-icon flag-icon-mx"></span> Mexican Peso (MXN)'>Mexican Peso (MXN)</option>
                    <option value="MYR" data-content='<span class="flag-icon flag-icon-my"></span> Malaysian Ringgit (MYR)'>Malaysian Ringgit (MYR)</option>
                    <option value="NOK" data-content='<span class="flag-icon flag-icon-no"></span> Norwegian Krone (NOK)'>Norwegian Krone (NOK)</option>
                    <option value="NZD" data-content='<span class="flag-icon flag-icon-nz"></span> New Zealand Dollar (NZD)'>New Zealand Dollar (NZD)</option>
                    <option value="PHP" data-content='<span class="flag-icon flag-icon-ph"></span> Philippine Peso (PHP)'>Philippine Peso (PHP)</option>
                    <option value="PLN" data-content='<span class="flag-icon flag-icon-pl"></span> Polish Złoty (PLN)'>Polish Złoty (PLN)</option>
                    <option value="RON" data-content='<span class="flag-icon flag-icon-ro"></span> Romanian Leu (RON)'>Romanian Leu (RON)</option>
                    <option value="RUB" data-content='<span class="flag-icon flag-icon-ru"></span> Russian Ruble (RUB)'>Russian Ruble (RUB)</option>
                    <option value="SEK" data-content='<span class="flag-icon flag-icon-se"></span> Swedish Krona (SEK)'>Swedish Krona (SEK)</option>
                    <option value="SGD" data-content='<span class="flag-icon flag-icon-sg"></span> Singapore Dollar (SGD)'>Singapore Dollar (SGD)</option>
                    <option value="THB" data-content='<span class="flag-icon flag-icon-th"></span> Thai Baht (THB)'>Thai Baht (THB)</option>
                    <option value="TRY" data-content='<span class="flag-icon flag-icon-tr"></span> Turkish Lira (TRY)'>Turkish Lira (TRY)</option>
                    <option value="USD" data-content='<span class="flag-icon flag-icon-us"></span> US Dollar (USD)'>US Dollar (USD)</option>
                    <option value="ZAR" data-content='<span class="flag-icon flag-icon-za"></span> South African Rand (ZAR)'>South African Rand (ZAR)</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Convert</button>
        </form>

        @if(session('converted_amount'))
            <div class="mt-4">
                <h3>Conversion Result: {{ session('original_amount') }} {{ session('from_currency') }} = {{ session('converted_amount') }} {{ session('to_currency') }}</h3>
            </div>
        @endif
    </div>
@endsection
