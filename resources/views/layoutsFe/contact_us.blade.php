<div class="col-md-4">
    <h3>Contact Us</h3>
    <div class="widget widget-address">
        <address>
            <span>{{$contact->location}}</span>
            <span><strong>Phone:</strong>{{$contact->phone}}</span>
            <span><strong>Fax:</strong>{{$contact->fax}}</span>
            <span><strong>Email:</strong><a href="mailto:{{$contact->email}}">{{$contact->email}}</a></span>
            <span><strong>Web:</strong><a href="{{$contact->web}}">{{$contact->web}}</a></span>
        </address>
    </div>
</div>