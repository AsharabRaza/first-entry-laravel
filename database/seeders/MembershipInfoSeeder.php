<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Memberships_info;

class MembershipInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Memberships_info::create([
            'membership_type' => 'enterprise_plus',
            'membership_nicename' => 'Enterprise+',
            'cost' => null,
            'monthly' => 169,
            'yearly_monthly' => 189,
            'total_yearly' => 2268,
            'manage_event' => 4,
            'events' => '9999999999/day',
            'event_analytics' => 'yes',
            'embed_form_link' => 'yes',
            'customize_online_forms' => 'yes',
            'custom_field' => 8,
            'amount_of_entries' => '999999999999/event/day',
            'amount_of_emails' => '999999999999/event',
            'emails_analytics' => 'yes',
            'first_entry_uid' => 'yes',
            'qr_scanning' => 'yes',
            'barcode_scanning' => 'yes',
            'addons' => '2500 messages',
            'sms_notification' => '89',
            'last_updated' => null,
            'date_created' => null,
        ]);

    }
}
