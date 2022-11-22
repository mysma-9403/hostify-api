<?php
declare(strict_types=1);

class EndpointsList
{
    public const GUESTS = 'guests';
    public const INVOICES = 'invoices';
    public const INVOICE = 'invoices/ID';
    public const COMPANIES = 'companies';
    public const COMPANY = 'companies/ID';
    public const COUNTERPARTIES = 'counterparties';
    public const COUNTERPARTY = 'counterparties/ID';
    public const RESERVATIONS = 'reservations';
    public const RESERVATION = 'reservations/ID';
    public const CALENDAR_BULK_LISTING = 'calendar/bulk_listings/ID';
    public const CALENDAR_BULK_LISTINGS = 'calendar/bulk_listings';
    public const LISTING = 'listings/ID';
    public const LISTING_UPDATE = 'listings/update';
}
