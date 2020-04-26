@extends('Makhzun::settings.layout')

@php
@endphp

@section('content-header')
    <button type="button" class="btn btn-primary btn-sm float-right" onclick="addNewCountry()"><i class="fas fa-fw mr-2 fa-plus"></i>Add Country</button>
    <h4 class="mt-1">Country :: State :: City</h4>
@stop

@section('modal')

@endsection

@section('content')
    <div class="row">
        <div class="col-3">
            <input type="text" class="form-control form-control-sm mb-1" id="filter-1587775138892663" name="filter" value="" placeholder="Filter ..." onkeyup="filterChanged(this.value)">
            <div class="nav flex-column nav-pills" id="countries-tab" role="tablist" aria-orientation="vertical"></div>
        </div>
        <div class="col-9">
            <div class="tab-content" id="countries-tabContent"></div>
        </div>
    </div>
@stop

@section('plugins.Toastr', true)

@push('js')
    <script type="text/javascript">
        let countries = @json(\Firumon\Makhzun\Model\Country::all()->keyBy->id),formClass = 'form-control form-control-sm col mr-sm-1 mb-sm-1';
        let selected = {}, states = {}, cities = {};
        $(function(){ populate(countries) })
        function populate(countries){ $('#countries-tab,#countries-tabContent').empty(); _.forEach(countries,addCountry) }
        function addCountry(country){ $('#countries-tab').append(countryTab(country,country.id));$('#countries-tabContent').append(countryTabContent(country,country.id)) }
        function countryTab(country) { return $('<a>',countryTabAttrs(country.id)).text(country.name); }
        function countryTabContent(country) { return $('<div>',countryTabContentAttrs(country.id)).html(countryTabContentHtml(country)); }
        function countryTabAttrs(id){ return { class:'nav-link',id:`country-${id}-tab`,'data-toggle':'pill',href:`#country-${id}`,role:'tab','aria-controls':`country-${id}`,'aria-selected':false,'data-record-id':id } }
        function countryTabContentAttrs(id){ return { class:'tab-pane fade',id:`country-${id}`,role:'tabpanel','aria-labelledby':`country-${id}-tab` } }
        function countryTabContentHtml(country) {
            return [$('<form>',{ onsubmit:'return submitCountryUpdateForm("'+country.id+'")',class:'form-inline form-row mb-4',name:'country-'+country.id+'-form'}).html(_.concat(
                $('<input>',{ type:'hidden',name:'id',value:country.id }),
                _.map(['name','sortname','currency','phonecode'],name => $('<input>',{ name,value:country[name],placeholder:name,class:formClass })),
                $('<select>',{ name:'status',class:formClass }).html(_.map(@json(mConfig('FORM_STATUS_OPTIONS')),option => $('<option>',{ value:option.id,selected:option.id === country.status }).text(option.name))),
                $('<a>',{ href:'javascript:fetchStates('+(country.id)+')',class:'col-5 btn btn-sm btn-outline-info' }).html([$('<i>',{ class:'fas fa fa-arrow-alt-circle-down mr-2' }),'Fetch States']),
                $('<input>',{ type:'submit',name:'action',value:'Update Country',class:'offset-2 col-5 btn btn-sm btn-outline-warning' }),
            )),$('<div>',{ class:'row',id:'country-'+country.id+'-states' })];
        }

        function filterChanged(value){ populate(_.filter(countries,country => _(country).values().join(' ').toLowerCase().includes(value.toLowerCase()))) }

        function fetchStates(country) { selected['country'] = country; $.getJSON(['{{ route('api_path') }}','country',country,'states'].join('/'),function(r){ states = _.keyBy(r,'id'); populateStates(country,r) }); }
        function populateStates(country,states) {
            $('#country-'+country+'-states').html([
                $('<div>',{ class:'col-7 states country-'+country+'-states' }).html(_.concat(stateAddForm(country),stateForms(states))),
                $('<div>',{ class:'col-5 cities' }),
            ]);
        }
        function stateAddForm(country) {
            return $('<form>',{ class:'form-inline form-row mb-4',name:'country-'+country+'-add-state-form',onsubmit:'return addCountryState('+country+')' }).html(stateAddFields(country))
        }
        function stateForms(states) {
            return _.map(states,state => $('<form>',{ class:'form-inline form-row',name:'state-'+state.id+'-form',onsubmit:'return submitStateUpdateForm("state-'+state.id+'-form")' }).html(stateFields(state)))
        }
        function fetchCityButton(id){ return $('<a>',{ href:'javascript:fetchCities('+(id)+')',class:'col btn btn-sm btn-outline-info ml-1',style:'margin-top:-4px' }).html(['Cities',$('<i>',{ class:'fas fa fa-arrow-alt-circle-right ml-1' })]) }
        function stateAddFields(country) {
            return [
                $('<input>',{ type:'hidden',name:'country',value:country }),
                $('<input>',{ class:formClass,name:'name',value:'' }),
                $('<select>',{ class:formClass,name:'status' }).html(_.map(@json(mConfig('FORM_STATUS_OPTIONS')),option => $('<option>',{ value:option.id }).text(option.name))),
                $('<input>',{ type:'submit',name:'action',value:'Add State',class:'col btn btn-sm btn-outline-warning',style:'margin-top:-4px' }),
            ]
        }
        function stateFields({ id,name,status }){
            return [
                $('<input>',{ type:'hidden',name:'id',value:id }),
                $('<input>',{ class:formClass,name:'name',value:name }),
                $('<select>',{ class:formClass,name:'status' }).html(_.map(@json(mConfig('FORM_STATUS_OPTIONS')),option => $('<option>',{ value:option.id,selected:option.id === status }).text(option.name))),
                $('<input>',{ type:'submit',name:'action',value:'Update State',class:'col btn btn-sm btn-outline-warning',style:'margin-top:-4px' }),
                fetchCityButton(id)
            ]
        }

        function fetchCities(state) { selected['state'] = state; $.getJSON(['{{ route('api_path') }}','state',state,'cities'].join('/'),function(r){ cities = _.keyBy(r,'id'); populateCities(state,r) }); }
        function populateCities(state,cities) {
            let country = selected['country'];
            $('#country-'+country+'-states .cities').html(_.concat(getCityHeadState(state),cityAddForm(state),cityForms(cities)));
        }
        function getCityHeadState(state) {
            return $('<h5>').text(_.get(states,[state,'name']) + ' :: Cities')
        }
        function cityAddForm(state) {
            return $('<form>',{ class:'form-inline form-row mb-4',name:'state-'+state+'-add-city-form',onsubmit:'return addCountryStateCity('+selected['country']+','+state+')' }).html(cityAddFields(state))
        }
        function cityForms(cities) {
            return _.map(cities,city => $('<form>',{ class:'form-inline form-row',name:'city-'+city.id+'-form',onsubmit:'return submitCityUpdateForm("city-'+city.id+'-form")' }).html(cityFields(city)))
        }
        function cityAddFields(state) {
            return [
                $('<input>',{ type:'hidden',name:'state',value:state }),
                $('<input>',{ type:'hidden',name:'country',value:selected['country'] }),
                $('<input>',{ class:formClass,name:'name',value:'' }),
                $('<select>',{ class:formClass,name:'status' }).html(_.map(@json(mConfig('FORM_STATUS_OPTIONS')),option => $('<option>',{ value:option.id }).text(option.name))),
                $('<input>',{ type:'submit',name:'action',value:'Add City',class:'col btn btn-sm btn-outline-warning',style:'margin-top:-4px' }),
            ]
        }
        function cityFields({ id,name,status }){
            return [
                $('<input>',{ type:'hidden',name:'id',value:id }),
                $('<input>',{ class:formClass,name:'name',value:name }),
                $('<select>',{ class:formClass,name:'status' }).html(_.map(@json(mConfig('FORM_STATUS_OPTIONS')),option => $('<option>',{ value:option.id,selected:option.id === status }).text(option.name))),
                $('<input>',{ type:'submit',name:'action',value:'Update',class:'col btn btn-sm btn-outline-warning',style:'margin-top:-4px' })
            ]
        }


        function addCountryState(country) {
            $.getJSON(['{{ route('api_path') }}','country',country,'state'].join('/'),$('[name="country-'+country+'-add-state-form"]').serializeArray(),function (state) {
                let country = state.country;
                $('form[name="country-'+country+'-add-state-form"]').after($('<form>',{ class:'form-inline form-row',name:'state-'+state.id+'-form' }).html(stateFields(state))).find('[name="name"]').val('');
            });
            return false;
        }
        function addCountryStateCity(country,state) {
            $.getJSON(['{{ route('api_path') }}','country',country,'state',state,'city'].join('/'),$('[name="state-'+state+'-add-city-form"]').serializeArray(),function (city) {
                let {country,state} = city;
                $('form[name="state-'+state+'-add-city-form"]').after($('<form>',{ class:'form-inline form-row',name:'state-'+state.id+'-form' }).html(cityFields(city))).find('[name="name"]').val('');
            });
            return false;
        }
        function submitCountryUpdateForm(id) {
            $.getJSON(['{{ route('api_path') }}','country/update'].join('/'),$('[name="country-'+id+'-form"]').serializeArray(),function(){
                toastr.success('Country updated successfully!!');
            })
            return false;
        }
        function submitStateUpdateForm(form) {
            $.getJSON(['{{ route('api_path') }}','state/update'].join('/'),$('form[name="'+form+'"]').serializeArray(),function () {
                toastr.success('State updated successfully!!');
            });
            return false;
        }
        function submitCityUpdateForm(form) {
            $.getJSON(['{{ route('api_path') }}','city/update'].join('/'),$('form[name="'+form+'"]').serializeArray(),function () {
                toastr.success('City updated successfully!!');
            });
            return false;
        }
    </script>
@endpush
