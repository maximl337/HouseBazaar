@inject('countries', 'App\Http\Utilities\Country')

        {{ csrf_field() }}
        <div class="form-group">
            <label for="street">Street</label>
            <input name="street" id="street" type="text" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input name="city" id="city" type="text" class="form-control" required>
        </div>
    
        <div class="form-group">
            <label for="zip">Zip/Postal Code</label>
            <input name="zip" id="zip" type="text" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="country">Country</label>

            <select class="form-control" name="country" id="country" required>

                @foreach($countries::all() as $country => $code)

                    <option value="{{ $code }}">{{ $country }}</option>

                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label for="state">State</label>
            <input name="state" id="state" type="text" class="form-control" required>
        </div>
        
        <hr />

        <div class="form-group">
            <label for="price">Sale Price</label>
            <input name="price" id="price" type="text" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Property Description</label>
            <textarea name="description" id="description" class="form-control" rows="10" required></textarea>
        </div>

        <div class="form-group">
            <input value="Create Property" type="submit" class="form-control btn btn-primary">
        </div>