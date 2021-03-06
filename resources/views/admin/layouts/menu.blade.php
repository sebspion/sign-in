    <li class="header">Administration</li>
<li class="{{ Request::is('members*') ? 'active' : '' }}">
    <a href="{!! route('members.index') !!}"><i class="fa fa-user"></i><span>Membres</span></a>
</li>
<li class="{{ Request::is('admin/transactions*') ? 'active' : '' }}">
    <a href="{!! route('admin.transactions.index') !!}"><i class="fa fa-dollar"></i><span>Cotisations</span></a>
</li>
<li class="{{ Request::is('admin/rfidCards*') ? 'active' : '' }}">
    <a href="{!! route('admin.rfidCards.index') !!}"><i class="fa fa-credit-card"></i><span>Rfid Cards</span></a>
</li>
<li class="{{ active('admin.services') }}">
    <a href="{!! route('admin.services') !!}"><i class="fa fa-cloud"></i><span>Services oauth</span></a>
</li>
<li class="{{ active('admin.notifications.index') }}">
    <a href="{!! route('admin.notifications.index') !!}"><i class="fa fa-dot-circle-o"></i><span>Log des Notifications</span></a>
</li>


    <li class="header">Configuration</li>

<li class="{{ Request::is('admin/paymentTypes*') ? 'active' : '' }}">
    <a href="{!! route('admin.paymentTypes.index') !!}"><i class="fa fa-edit"></i><span>Types de paiement</span></a>
</li>

<li class="{{ Request::is('admin/transactionTypes*') ? 'active' : '' }}">
    <a href="{!! route('admin.transactionTypes.index') !!}"><i class="fa fa-edit"></i><span>Types de transaction</span></a>
</li>
