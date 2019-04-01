
{* file to extend *}
{extends file="parent:frontend/index/index.tpl"}

{* our plugin namespace *}
{namespace name="frontend/ost-order-info/index"}



{* add our plugin to the breadcrumb *}
{block name='frontend_index_start'}
    {$smarty.block.parent}
    {assign var="breadcrumbName" value="Auftragsauskunft"}
    {$sBreadcrumb[] = ['name' => $breadcrumbName, 'link'=> ""]}
{/block}



{* always show account sidebar *}
{block name="frontend_index_left_categories"}
    {include file="frontend/account/sidebar.tpl" showSidebar=true}
{/block}



{* main content *}
{block name='frontend_index_content'}

    {* show the login *}
    {if $ostOrderInfo.isLoggedIn == false}

        {* login *}
        <div class="content ost-order-info ost-order-info--login">

            {if $ostOrderInfo.error == 1}
                {$alertMessage = "Zu der eingegebenen Kombination aus Bestell- und Kundennummer wurde kein Auftrag gefunden."}
                {$alertType = "error"}
                {$alertIcon = "cross"}
            {/if}

            {if $ostOrderInfo.error > 0}
                <div class="ost-order-info--alert alert is--{$alertType} is--rounded">
                    <div class="alert--icon">
                        <i class="icon--element icon--{$alertIcon}"></i>
                    </div>
                    <div class="alert--content">
                        {$alertMessage}
                    </div>
                </div>
            {/if}

            <div class="panel has--border is--rounded">

                <h2 class="panel--title is--underline">
                    {s name='login-header'}Auftragauskunft{/s}
                </h2>

                <div class="panel--body is--wide">
                    <p>
                        {s name='login-text'}Melde dich mit deiner Auftrags- und deiner Kundennummer an, um den Status deines Auftrags abzufragen.{/s}
                    </p>
                    <form action="{url controller="OstOrderInfo" action="index"}" method="post">
                        <input type="text" name="orderNumber" required="required" aria-required="true" placeholder="{s name='login-placeholder-order-number'}Ihre Auftragsnummer*{/s}" class="is--required ost-order-info--login--order-number" value="" />
                        <input type="text" name="customerNumber" required="required" aria-required="true" placeholder="{s name='login-placeholder-email-address'}Ihre Kundennummer*{/s}" class="is--required ost-order-info--login--customer-number" value="" />
                        <input type="submit" name="submit" value="{s name='login-button'}Auftragauskunft abfragen{/s}" class="btn is--primary is--large" />
                    </form>
                </div>

            </div>
        </div>

    {else}

        {* order as short variable *}
        {assign var="order" value=$ostOrderInfo.order}

        {* order info *}
        <div class="content ost-order-info ost-order-info--index">

            <div class="header--container panel">
                <h1 class="panel--title">{s name='header'}Auftragsauskunft{/s}</h1>
            </div>

            <div class="status--container">
                {if $order.status.key > 0}
                    {assign var="file" value="frontend/_public/src/img/status-banner/status-0{$order.status.key}.jpg"}
                    <img class="status-image" src="{link file=$file}" />
                {/if}

                {if $order.status.type == 0 || $order.status.type == 1 || $order.status.type == 2}
                    {$type = "info"}
                    {$icon = "info"}
                {/if}
                {if $order.status.type == 3}
                    {$type = "error"}
                    {$icon = "cross"}
                {/if}

                <div class="alert is--{$type} is--rounded">
                    <div class="alert--icon">
                        <i class="icon--element icon--{$icon}"></i>
                    </div>
                    <div class="alert--content">
                        {$order.status.info}
                    </div>
                </div>

            </div>

            <div class="customer--billing-address panel has--border is--rounded">
                <h2 class="panel--title is--underline">Rechnungsanschrift</h2>
                <div class="panel--body is--wide">
                    <p>
                        {if $order.billingCompany != ""}
                            {$order.billingCompany}<br />
                        {/if}

                        {if $order.billingSalutation == "0"}
                            Herr
                        {/if}
                        {if $order.billingSalutation == "1"}
                            Frau
                        {/if}
                        {$order.billingFirstname} {$order.billingLastname}<br />
                        {$order.billingStreet}<br />
                        {$order.billingZip} {$order.billingCity}
                    </p>
                </div>
            </div>

            <div class="customer--shipping-address panel has--border is--rounded">
                <h2 class="panel--title is--underline">Lieferanschrift</h2>
                <div class="panel--body is--wide">
                    <p>
                        {if $order.shippingCompany != ""}
                            {$order.shippingCompany}<br />
                        {/if}
                        {if $order.shippingSalutation == "0"}
                            Herr
                        {/if}
                        {if $order.shippingSalutation == "1"}
                            Frau
                        {/if}
                        {$order.shippingFirstname} {$order.shippingLastname}<br />
                        {$order.shippingStreet}<br />
                        {$order.shippingZip} {$order.shippingCity}
                    </p>
                </div>
            </div>

            <div class="base-info--container panel has--border is--rounded">
                <h2 class="panel--title is--underline">Weitere Informationen</h2>
                <div class="panel--body is--wide">
                    <p>
                        Bestellnummer: {$order.number}<br />
                        Kundennummer: {$order.customerNumber}<br />
                        Datum: {$order.orderDate}<br />
                        Zahlungsart: {$order.paymentName}<br />
                        Versandart: {$order.dispatchName}<br />
                        Liefertermin:
                            {if $order.deliveryDate != ""}
                                {$order.deliveryDate}
                            {else}
                                {if $order.deliveryCalendarWeek != ""}
                                    {$order.deliveryCalendarWeek}
                                {else}
                                    Unbekannt
                                {/if}
                            {/if}
                    </p>
                </div>
            </div>

            <div class="positions--container panel has--border is--rounded">
                <div class="panel--body is--wide">
                    <div class="panel--table positions--table">
                        <div class="positions--table-header panel--tr">
                            <div class="panel--th column--number">Artikel</div>
                            <div class="panel--th column--name">Name</div>
                            <div class="panel--th column--quantity">Anzahl</div>
                            <div class="panel--th column--price">Preis</div>
                        </div>
                        {foreach $order.positions as $position}
                            <div class="positions--table-item panel--tr">
                                <div class="order--date panel--td column--number">
                                    {$position.number}
                                </div>
                                <div class="order--date panel--td column--name">
                                    {$position.name}
                                </div>
                                <div class="order--date panel--td column--quantity">
                                    {$position.quantity}
                                </div>
                                <div class="order--date panel--td column--price">
                                    {$position.amount|currency}
                                </div>
                            </div>
                        {/foreach}
                    </div>
                    <div class="panel--table sums--table">
                        <div class="sums--table-item panel--tr">
                            <div class="order--date panel--td column--description">
                                Artikel:
                            </div>
                            <div class="order--date panel--td column--amount">
                                {$order.articleAmount|currency}
                            </div>
                        </div>
                        <div class="sums--table-item panel--tr">
                            <div class="order--date panel--td column--description">
                                Nachlass:
                            </div>
                            <div class="order--date panel--td column--amount">
                                {$order.orderDiscount|currency}
                            </div>
                        </div>
                        <div class="sums--table-item panel--tr">
                            <div class="order--date panel--td column--description">
                                Skonto:
                            </div>
                            <div class="order--date panel--td column--amount">
                                {$order.orderDevalued|currency}
                            </div>
                        </div>
                        <div class="sums--table-item panel--tr">
                            <div class="order--date panel--td column--description">
                                Anzahlung:
                            </div>
                            <div class="order--date panel--td column--amount">
                                -{$order.advancePayment|currency}
                            </div>
                        </div>
                        <div class="sums--table-item panel--tr" style="font-weight: bold;">
                            <div class="order--date panel--td column--description">
                                Restbetrag:
                            </div>
                            <div class="order--date panel--td column--amount">
                                {$order.remainingAmount|currency}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="customer-service--container panel has--border is--rounded">
                <h2 class="panel--title is--underline">Unser Kundenservice</h2>
                <div class="panel--body is--wide">
                    <p>
                        Bei Rückfragen oder Wünschen zu einem neuen Termin wenden Sie sich bitte an:<br />
                        Telefon: +49 (2302) 985-0<br />
                        E-Mail: kontakt@ostermann.de
                    </p>
                </div>
            </div>

        </div>

    {/if}

{/block}
