<?php

namespace App\Util;

class Constant {

    const USER_ROLE_USER = 'USER';
    const USER_ROLE_ADMIN = 'ADMIN';
    const USER_ROLE_HRD = 'HRD';

    const USER_ROLES = [
        self::USER_ROLE_USER => 'Pengguna',
        self::USER_ROLE_ADMIN => 'Super Admin',
        self::USER_ROLE_HRD => 'HRD',
    ];

    const ADMIN_ROLES_LIST = [
        self::USER_ROLE_ADMIN,
    ];

    const COMMON_STATUS_ACTIVE = 'ACTIVE';
    const COMMON_STATUS_INACTIVE = 'INACTIVE';

    const COMMON_STATUS_LIST = [
        self::COMMON_STATUS_ACTIVE => 'ACTIVE',
        self::COMMON_STATUS_INACTIVE => 'INACTIVE',
    ];

    const COMMON_STATUS_LABEL_LIST = [
        self::COMMON_STATUS_ACTIVE => 'info',
        self::COMMON_STATUS_INACTIVE => 'danger',
    ];

    const NOTIFICATION_STATUS_READ = 'READ';
    const NOTIFICATION_STATUS_UNREAD = 'UNREAD';

    const NOTIFICATION_STATUS = [
        self::NOTIFICATION_STATUS_READ => 'Terbaca',
        self::NOTIFICATION_STATUS_UNREAD => 'Belum Dibaca',
    ];

    const NOTIFICATION_TYPE_OTHER = 'OTHER';

    const NOTIFICATION_TYPE = [
        self::NOTIFICATION_TYPE_OTHER => 'Lainnya',
    ];

    const NOTIFICATION_ICON = [
        self::NOTIFICATION_TYPE_OTHER => 'tags',
    ];

    const NOTIFICATION_LINK = [
        self::NOTIFICATION_TYPE_OTHER => 'settings',
    ];

    const COMMON_YES = '1';
    const COMMON_NO = '0';

    const COMMON_YESNO_LIST = [
        self::COMMON_YES => 'YES',
        self::COMMON_NO => 'NO',
    ];

    const COMMON_YESNO_LABEL_LIST = [
        self::COMMON_YES => 'Ya',
        self::COMMON_NO => 'Tidak',
    ];

    const COMMON_STATUS_AVAILABLE = 'AVAILABLE';
    const COMMON_STATUS_UNAVAILABLE = 'UNAVAILABLE';

    const COMMON_STATUS_AVAILABLE_LIST = [
        self::COMMON_STATUS_AVAILABLE => 'Tersedia',
        self::COMMON_STATUS_UNAVAILABLE => 'Tidak Tersedia',
    ];

    const COMMON_STATUS_AVAILABLE_LABEL_LIST = [
        self::COMMON_STATUS_AVAILABLE => 'success',
        self::COMMON_STATUS_UNAVAILABLE => 'danger',
    ];

    const MEMBER_TYPES_GUEST = 'GUEST';
    const MEMBER_TYPES_MEMBER = 'MEMBER';

    const MEMBER_TYPES_LIST = [
        self::MEMBER_TYPES_GUEST => 'Tamu',
        self::MEMBER_TYPES_MEMBER => 'Pelanggan',
    ];

    const ORDER_STATUS_NEW = 'NEW';
    const ORDER_STATUS_PAYMENT_COMPLETE = 'PAYMENT_COMPLETE';
    const ORDER_STATUS_PROGRESS = 'PROGRESS';
    const ORDER_STATUS_COMPLETED = 'COMPLETED';
    const ORDER_STATUS_CANCELLED = 'CANCELLED';

    const ORDER_STATUS_LIST = [
        self::ORDER_STATUS_NEW => 'Baru',
        self::ORDER_STATUS_PAYMENT_COMPLETE => 'Sudah Dibayar',
        self::ORDER_STATUS_PROGRESS => 'Diproses',
        self::ORDER_STATUS_COMPLETED => 'Selesai',
        self::ORDER_STATUS_CANCELLED => 'Dibatalkan',
    ];

    const ORDER_STATUS_LABEL_LIST = [
        self::ORDER_STATUS_NEW => 'primary',
        self::ORDER_STATUS_PAYMENT_COMPLETE => 'warning',
        self::ORDER_STATUS_PROGRESS => 'success',
        self::ORDER_STATUS_COMPLETED => 'info',
        self::ORDER_STATUS_CANCELLED => 'danger',
    ];

    const STATUS_PAYMENT_UNPAID = 'UNPAID';
    const STATUS_PAYMENT_HALF_PAID = 'HALF_UNPAID';
    const STATUS_PAYMENT_PAID = 'PAID';

    const STATUS_PAYMENT_LIST = [
        self::STATUS_PAYMENT_UNPAID => 'Belum Bayar',
        self::STATUS_PAYMENT_HALF_PAID => 'Bayar DP',
        self::STATUS_PAYMENT_PAID => 'Lunas',
    ];

    const STATUS_PAYMENT_LABEL_LIST = [
        self::STATUS_PAYMENT_UNPAID => 'danger',
        self::STATUS_PAYMENT_HALF_PAID => 'warning',
        self::STATUS_PAYMENT_PAID => 'success',
    ];

    const PAYMENT_METHOD_CASH = 'CASH';
    const PAYMENT_METHOD_TRANSFER = 'TRANSFER';

    const PAYMENT_METHOD_LIST = [
        self::PAYMENT_METHOD_CASH => 'Tunai',
        self::PAYMENT_METHOD_TRANSFER => 'Transfer',
    ];

    const PRODUCT_TYPE_PRICE_SINGLE = 'SINGLE';
    const PRODUCT_TYPE_PRICE_FIFTY = 'FIFTY';
    const PRODUCT_TYPE_PRICE_HUNDRED = 'HUNDRED';
    const PRODUCT_TYPE_PRICE_FIVE_HUNDRED = 'FIVE_HUNDRED';

    const PRODUCT_TYPE_PRICE_LIST = [
        self::PRODUCT_TYPE_PRICE_SINGLE => 'Satuan',
        self::PRODUCT_TYPE_PRICE_FIFTY => 'Min 50',
        self::PRODUCT_TYPE_PRICE_HUNDRED => 'Min 100',
        self::PRODUCT_TYPE_PRICE_FIVE_HUNDRED => 'Min 500',
    ];

    const STOCK_TYPE_PRODUCT = 'PRODUCT';
    const STOCK_TYPE_ORDER = 'ORDER';
    const STOCK_TYPE_ORDER_CANCEL = 'ORDER_CANCEL';

    const STOCK_TYPE_LIST = [
        self::STOCK_TYPE_PRODUCT => 'Product',
        self::STOCK_TYPE_ORDER => 'Order',
        self::STOCK_TYPE_ORDER_CANCEL => 'Cancel',
    ];

    const ORDER_MACHINE_STATUS_PROGRESS = 'PROGRESS';
    const ORDER_MACHINE_STATUS_COMPLETE = 'COMPLETE';
    const ORDER_MACHINE_STATUS_CANCELLED = 'CANCELLED';

    const ORDER_MACHINE_STATUS_LIST = [
        self::ORDER_MACHINE_STATUS_PROGRESS => 'Progress',
        self::ORDER_MACHINE_STATUS_COMPLETE => 'Complete',
        self::ORDER_MACHINE_STATUS_CANCELLED => 'Cancelled',
    ];

    const PAGES_TYPES_HOME = 'HOME';
    const PAGES_TYPES_ABOUT = 'ABOUT';
    const PAGES_TYPES_PRODUCT = 'PRODUCT';
    const PAGES_TYPES_CAREER = 'CAREER';

    const PAGES_TYPES = [
        self::PAGES_TYPES_HOME => 'Beranda',
        self::PAGES_TYPES_ABOUT => 'Tentang',
        self::PAGES_TYPES_PRODUCT => 'Product',
        self::PAGES_TYPES_CAREER => 'Karir',
    ];

    const CAREER_CATEGORY_STAFF = 'STAFF';
    const CAREER_CATEGORY_SUPERVISOR = 'SUPERVISOR';
    const CAREER_CATEGORY_MANAGER = 'MANAGER';
    const CAREER_CATEGORY_OTHER = 'OTHER';

    const CAREER_CATEGORY_LIST = [
        self::CAREER_CATEGORY_STAFF => 'Staff',
        self::CAREER_CATEGORY_SUPERVISOR => 'Supervisor',
        self::CAREER_CATEGORY_MANAGER => 'Manager',
        self::CAREER_CATEGORY_OTHER => 'Lainnya',
    ];

    const CAREER_TYPES_FULL_TIME = 'FULL_TIME';
    const CAREER_TYPES_PART_TIME = 'PART_TIME';
    const CAREER_TYPES_FREELANCE = 'FREE_LANCE';
    const CAREER_TYPES_OTHER = 'OTHER';

    const CAREER_TYPES_LIST = [
        self::CAREER_TYPES_FULL_TIME => 'Full Time',
        self::CAREER_TYPES_PART_TIME => 'Part Time',
        self::CAREER_TYPES_FREELANCE => 'Freelance',
        self::CAREER_TYPES_OTHER => 'Lainnya',
    ];

}
