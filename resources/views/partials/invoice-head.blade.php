<div class="col-md-12">
    <div class="pull-left">
        <address>
            <img src="{{ asset('images/logo.png') }}" alt="">
            {{--<h4>Express Shipping & Logistics (EA) Limited</h4>--}}
            <h4>Cannon Towers </h4><h4>
                6th Floor, Moi Avenue Mombasa - Kenya </h4><h4>
                <b>Tax Registration</b>: 0121303W </h4><h4>
                <b>Telephone</b>: +254 41 2229784 </h4><h4>
                <b>Email</b> :agency@esl-eastafrica.com or <br> ops@esl-eastafrica.com </h4><h4>
                <b>Web</b>: www.esl-eastafrica.com
            </h4>
            <hr>
            {{--<br>--}}
            <h4><b>TO : </b>{{ ucwords($quotation->lead->name) }}</h4>
            <h4><strong>Contact Person : </strong> {{ ucwords($quotation->lead->contact_person) }}
                <br/><strong>Tel : </strong> {{ $quotation->lead->telephone }}
                <br/><strong>Email : </strong>{{ $quotation->lead->email }}
                <br/><strong>Phone : </strong> {{ $quotation->lead->phone }}
            </h4>
        </address>
    </div>
    <div class="pull-right">
        <div class="row">
            <div class="form-group">
                <h1 style="color: {{ $quotation->status == 'pending' ? 'red' : ($quotation->status == 'accepted' || $quotation->status == 'converted' ? 'green' : 'gray') }}">{{ strtoupper($quotation->status == 'pending' ? 'DRAFT' : ($quotation->status == 'waiting' ? 'PROFORMA DISBURSEMENT' : 'PROFORMA DISBURSEMENT')) }}</h1>
                {{--<h3>Tax Registration: 0121303W</h3>--}}
                {{--<h3>Telephone: +254 41 2229784</h3>--}}
                {{--<label><h4><b>Currency</b></h4></label>--}}
                {{--<select class="form-control" name="currency" id="currency">--}}
                {{--<option value="">Select Currency</option>--}}
                {{--<option value="usd">USD</option>--}}
                {{--<option value="kes">KES</option>--}}
                {{--</select>--}}
            </div>
        </div>
        <address>
            <h4><b>PDA No</b> {{$quotation->id}}</h4>
            <h4><b>Voyage No</b> {{ $quotation->voyage == null ? '' : strtoupper($quotation->voyage->voyage_no) }}</h4>
            <h4>Currency : {{ $quotation->lead->currency }}</h4>
            <h4 id="vessel_name"><b>VESSEL</b> {{ strtoupper($quotation->vessel->name )}}</h4>
            <h4 id="grt"><b>GRT</b> {{ $quotation->vessel->grt }} GT</h4>
            <h4 id="loa"><b>LOA</b> {{ $quotation->vessel->loa }} M</h4>
            <h4 id="port"><b>PORT</b> {{ strtoupper($quotation->vessel->port_of_discharge) }}</h4>
            <h4><b>CARGO </b>
                @foreach($quotation->cargos as $cargo)
                    {{ ucwords($cargo->name) }},
                @endforeach
            </h4>
            @if(count($quotation->cargos) > 0)
                <h4><b>CARGO  QUANTITY </b> {{ $quotation->cargos->sum('weight') }} MT</h4>
                <h4><b>DISCHARGE RATE</b>  {{ $quotation->cargos->first()->discharge_rate }}  MT / WWD</h4>
                <h4><b>PORT STAY  </b> {{$quotation->cargos->first()->discharge_rate !=0 ? ceil(($quotation->cargos->sum('weight'))/$quotation->cargos->first()->discharge_rate) : '0' }} Days</h4>
            @endif
            <p><b>Date : </b> {{ \Carbon\Carbon::parse($quotation->updated_at)->format('d-M-y') }}</p>
        </address>
    </div>
</div>
