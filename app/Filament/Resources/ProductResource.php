<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

public static function form(Form $form): Form
{
    return $form->schema([
        // بخش اطلاعات اصلی (کدهای قبلی...)
        Section::make('Product Information')
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                Forms\Components\TextInput::make('slug')->required(),
                Forms\Components\TextInput::make('price')->numeric()->required(),
                Forms\Components\TextInput::make('stock')->numeric()->required(),
                Forms\Components\Toggle::make('is_active')->default(true),
            ])->columns(2),

        // بخش جدید برای آپلود تصاویر
        Section::make('Product Images')
            ->schema([
                FileUpload::make('images') // نام فیلد در فرم
                    ->relationship('images', 'path') // ایجاد رابطه خودکار با جدول product_images
                    ->multiple() // قابلیت انتخاب چند فایل
                    ->directory('products') // پوشه‌ای که عکس‌ها در آن ذخیره می‌شوند
                    ->image() // فقط اجازه آپلود عکس
                    ->reorderable() // قابلیت جابجایی ترتیب عکس‌ها
                    ->columnSpanFull(),
            ])
    ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            // اضافه کردن ستون عکس در ابتدای لیست
            Tables\Columns\ImageColumn::make('images.path')
                ->label('Image')
                ->circular() // نمایش به صورت دایره‌ای
                ->limit(1), // فقط اولین عکس را نشان بده
            
            Tables\Columns\TextColumn::make('name')->searchable(),
            // بقیه ستون‌ها...
        ]);
}

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
