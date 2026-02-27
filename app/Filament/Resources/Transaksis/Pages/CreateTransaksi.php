<?php

namespace App\Filament\Resources\Transaksis\Pages;

use App\Filament\Resources\Transaksis\TransaksiResource;
use App\Models\detail_transaksi;
use App\Models\meja;
use App\Models\menu;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;

class CreateTransaksi extends CreateRecord
{
    protected static string $resource = TransaksiResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $detailItems = $data['detail_transaksi'] ?? [];
        unset($data['detail_transaksi']);



        foreach ($detailItems as $item ) {
            $menuItem = menu::find($item['menu_id']);
            if (!$menuItem || $menuItem->stok < $item['qty']) {
                Notification::make()
                    ->title('Stok tidak mencukupi untuk menu: ' . ($menuItem->nama ?? 'Unknown'))
                    ->danger()
                    ->send();

                $this->halt();
            }

            $mejaCheck = meja::find($data['meja_id']);
            if (!$mejaCheck || $mejaCheck->status !== 'kosong') {
                Notification::make()
                    ->title('Meja tidak tersedia atau sudah dipesan.')
                    ->body('Silakan pilih meja lain yang tersedia.')
                    ->danger()
                    ->send();

                $this->halt();
            }
        }


        $transaksi = static::getModel()::create($data);

        foreach ($detailItems as $item) {

        detail_transaksi::create([
                'transaksi_id' => $transaksi->id,
                'menu_id' => $item['menu_id'],
                'qty' => $item['qty'],
                'harga' => $item['harga'],
            ]);

        menu::find($item['menu_id'])->decrement('stok', $item['qty']);

        }

        meja::where('id', $data['meja_id'])->update(['status' => 'Dipesan']);

        Notification::make()
            ->title('transaksi berhasil')
            ->body('stok, meja, dan detail transaksi telah diperbarui.')
            ->success()
            ->icon(Heroicon::OutlinedCheckCircle)
            ->iconColor('green')

            ->persistent()

            ->send();

        return $transaksi;
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
