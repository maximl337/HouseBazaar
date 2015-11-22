@inject('countries', 'App\Http\Utilities\Country')

@inject('property_types', 'App\Http\Utilities\PropertyType')

        {{ csrf_field() }}

        <fieldset>

            <legend>Location</legend>

            <div class="form-group">
                <label for="street">Street *</label>
                <input name="street" id="street" type="text" class="form-control" required value="{{ old('street') }}">
            </div>

            <div class="form-group">
                <label for="city">City *</label>
                <input name="city" id="city" type="text" class="form-control" required value="{{ old('city') }}">
            </div>
        
            <div class="form-group">
                <label for="zip">Zip/Postal Code *</label>
                <input name="zip" id="zip" type="text" class="form-control" required value="{{ old('zip') }}">
            </div>

            <div class="form-group">
                <label for="country">Country *</label>

                <select class="form-control" name="country" id="country" required>

                    @foreach($countries::all() as $country => $code)

                        <option value="{{ $code }}">{{ $country }}</option>

                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="state">State *</label>
                <input name="state" id="state" type="text" class="form-control" required value="{{ old('state') }}">
            </div>
            
        </fieldset>
       
        
        <fieldset>
            
            <legend>Price and description</legend>

            <div class="form-group">
                <label for="price">Sale Price</label>
                <input name="price" id="price" type="text" class="form-control" value="{{ old('price') }}">
            </div>

            <div class="form-group">
                <label for="description">Property Description *</label>
                <textarea name="description" id="description" class="form-control" rows="10" required>{{ old('description') }}</textarea>
            </div>

        </fieldset>

        <fieldset>
            <legend> Details </legend>

            <div class="form-group">
                <label for="bedrooms">Bedrooms *</label>
                <select id="bedrooms" name="bedrooms" class="form-control">
                    <option value="0">Bachelor/Studio</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6 or more</option>
                </select>
            </div>

            <div class="form-group">
                <label for="bathrooms">Bathrooms *</label>
                <select id="bathrooms" name="bathrooms" class="form-control">
                    <option value="1">1</option>
                    <option value="1.5">1.5</option>
                    <option value="2">2</option>
                    <option value="2.5">2.5</option>
                    <option value="3">3</option>
                    <option value="3.5">3.5</option>
                    <option value="4">4</option>
                    <option value="4.5">4.5</option>
                    <option value="5">5</option>
                    <option value="5.5">5.5</option>
                    <option value="6">6 or more</option>
                </select>
            </div>

            <div class="form-group">
                <label for="transaction_type">Rent or Sale? *</label>
                <select id="transaction_type" name="transaction_type" class="form-control">
                    <option value="rent">For rent</option>
                    <option value="sale">For sale</option>
                </select>
            </div>

            <div class="form-group">
                <label for="property_type">Property type *</label>
                <select id="property_type" name="property_type" class="form-control">
                    @foreach($property_types::all() as $type)

                        <option value="{{ $type }}">{{ ucfirst($type) }}</option>

                    @endforeach
                </select>
            </div>
        
            <div class="form-group">
                <label for="size_square_feet">Size (sqft)</label>
                <input id="size_square_feet" class="form-control" type="text" name="size_square_feet" value="{{ old('size_square_feet') }}" placeholder="eg: 2500" />
            </div>

             <div class="checkbox">
              <label><input type="checkbox" name="furnished" value="1"><strong></strong>Furnished</label>
            </div>  

            <div class="checkbox">
              <label><input type="checkbox" name="pets" value="1">Pets</label>
            </div>

            <div class="form-group">
                <label for="youtube_url">Youtube Video Link</label>
                <input id="youtube_url" class="form-control" type="text" name="youtube_url" value="{{ old('youtube_url') }}" placeholder="Enter a link to a youtube video" />
            </div>

            <div class="form-group">
                <label for="seller_type">You are:</label>
                <select id="seller_type" name="seller_type" class="form-control">
                    <option value="owner">Owner</option>
                    <option value="professional">Professional / Real Estate Agent</option>
                </select>
            </div>

            <div class="checkbox">
              <label><input type="checkbox" name="allow_comments" value="1">Allow comments on property page</label>
            </div>

        </fieldset>

        <fieldset>
            
            <legend>Pictures</legend>

            <div class="form-group">
                <label for="photos">Photos</label>
                <input type="file" id="photos" name="photos[]" multiple>
                <p class="help-block">Maximum 10 files with each file not exceeding 5 MB</p>
            </div>
            

        </fieldset>
            
        
        <fieldset>

            <legend>Contact Details</legend>

            <div class="form-group">
                <label for="contact_phone_1">Contact: Phone 1</label>
                <input id="contact_phone_1" class="form-control" type="text" name="contact_phone_1" value="{{ old('contact_phone_1') }}" placeholder="Enter a contact phone number" />
            </div>
            
            <div class="form-group">
                <label for="contact_phone_2">Contact: Phone 2</label>
                <input id="contact_phone_2" class="form-control" type="text" name="contact_phone_2" value="{{ old('contact_phone_2') }}" placeholder="Enter another contact phone number" />
            </div>

            <div class="form-group">
                <label for="contact_email">Contact: Email</label>
                <input id="contact_email" class="form-control" type="text" name="contact_email" value="{{ old('contact_email') }}" placeholder="Enter a contact email address" />
            </div>

        </fieldset>

        
        
       
       
        <div class="form-group">
            {!! Recaptcha::render() !!}
        </div>

        <div class="form-group">
            <input value="Save and add photos" type="submit" class="form-control btn btn-primary">
        </div>

 