<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\SatuanBesar
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\SatuanBesarFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanBesar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanBesar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanBesar onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanBesar query()
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanBesar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanBesar whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanBesar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanBesar whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanBesar whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanBesar withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanBesar withoutTrashed()
 * @mixin \Eloquent
 */
	class SatuanBesar extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SatuanKecil
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\SatuanKecilFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanKecil newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanKecil newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanKecil onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanKecil query()
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanKecil whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanKecil whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanKecil whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanKecil whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanKecil whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanKecil withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SatuanKecil withoutTrashed()
 * @mixin \Eloquent
 */
	class SatuanKecil extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Suplier
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $contact
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\SuplierFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Suplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Suplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Suplier onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Suplier query()
 * @method static \Illuminate\Database\Eloquent\Builder|Suplier whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Suplier whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Suplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Suplier whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Suplier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Suplier whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Suplier whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Suplier withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Suplier withoutTrashed()
 * @mixin \Eloquent
 */
	class Suplier extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Telur
 *
 * @property int $id
 * @property string $name
 * @property int $satuan_besar_id
 * @property int $isi_satuan_kecil
 * @property int $satuan_kecil_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\SatuanBesar $satuanBesar
 * @property-read \App\Models\SatuanKecil $satuanKecil
 * @method static \Database\Factories\TelurFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Telur newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Telur newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Telur onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Telur query()
 * @method static \Illuminate\Database\Eloquent\Builder|Telur whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telur whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telur whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telur whereIsiSatuanKecil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telur whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telur whereSatuanBesarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telur whereSatuanKecilId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telur whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telur withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Telur withoutTrashed()
 * @mixin \Eloquent
 */
	class Telur extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TransaksiMasuk
 *
 * @property int $id
 * @property string $tanggal_masuk
 * @property int $suplier_id
 * @property string $insert_stok
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Suplier|null $suplier
 * @method static \Database\Factories\TransaksiMasukFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiMasuk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiMasuk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiMasuk query()
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiMasuk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiMasuk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiMasuk whereInsertStok($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiMasuk whereSuplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiMasuk whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiMasuk whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class TransaksiMasuk extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TransaksiMasukDetail
 *
 * @property-read \App\Models\TransaksiMasuk|null $tMasuk
 * @property-read \App\Models\Telur|null $telur
 * @method static \Database\Factories\TransaksiMasukDetailFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiMasukDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiMasukDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiMasukDetail query()
 */
	class TransaksiMasukDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property mixed $password
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 */
	class User extends \Eloquent {}
}

