<style>
        /* ===== RESET ===== */
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f7fafc;
            color: #1f2937;
            transition: background-color .3s, color .3s;
        }

        /* ===== DARK MODE GLOBAL ===== */
        .dark body {
            background: #111827;
            color: #f9fafb;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 220px;
            background: #2f855a;
            color: white;
            display: flex;
            flex-direction: column;
            z-index: 200;
            transition: background-color .3s;
        }

        .dark .sidebar {
            background: #1f2937;
        }

        .sidebar h2 {
            text-align: center;
            padding: 20px 0;
            margin: 0;
            font-size: 20px;
            border-bottom: 1px solid rgba(255,255,255,.2);
        }

        /* ===== MENU ===== */
        .menu a {
            display: block;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            transition: background .2s;
        }

        .menu a:hover,
        .menu a.active {
            background: #276749;
            font-weight: bold;
        }

        .dark .menu a:hover,
        .dark .menu a.active {
            background: #374151;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            position: fixed;
            top: 0;
            left: 220px;
            right: 0;
            height: 50px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 20px;
            gap: 10px;
            z-index: 150;
            transition: background-color .3s, border-color .3s;
        }

        .dark .topbar {
            background: #1f2937;
            border-color: #374151;
        }

        /* ===== BUTTON ===== */
        .btn-logout-top {
            background: #c53030;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-logout-top:hover {
            background: #9b2c2c;
        }

        .btn-theme {
            background: #e5e7eb;
            border: none;
            padding: 6px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .dark .btn-theme {
            background: #374151;
            color: #f9fafb;
        }

        /* ===== CONTENT ===== */
        .content {
            margin-left: 220px;
            padding: 80px 30px 30px;
            width: calc(100% - 220px);
            min-height: 100vh;
        }

        /* ===== CARD ===== */
        .card,
        .form-wrapper {
            background: white;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,.1);
            transition: background-color .3s;
        }

        .dark .card,
        .dark .form-wrapper {
            background: #1f2937;
            color: #f9fafb;
        }

        /* ===== TABLE ===== */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #cbd5e0;
            padding: 8px;
            text-align: left;
        }

        table th {
            background: #edf2f7;
        }

        .dark table th {
            background: #374151;
        }

        .dark table td {
            background: #1f2937;
            border-color: #4b5563;
        }

        /* ===== FORM ===== */
        input, textarea, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
        }

        .dark input,
        .dark textarea,
        .dark select {
            background: #374151;
            color: #f9fafb;
            border-color: #4b5563;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
            }

            .topbar {
                left: 0;
            }

            .content {
                margin-left: 0;
                width: 100%;
            }
        }
		
		/* ===== FIX DASHBOARD CARD TEXT ===== */
		.card h1,
		.card h2,
		.card h3,
		.card h4 {
			color: #1f2937;
		}

		.card p {
			color: #4b5563;
		}

		/* Dark mode override */
		.dark .card h1,
		.dark .card h2,
		.dark .card h3,
		.dark .card h4 {
			color: #f9fafb !important;
		}

		.dark .card p {
			color: #e5e7eb !important;
		}
		
		html:not(.theme-ready) * {
			transition: none !important;
		}
		
		/* ===== ACTION BUTTONS ===== */
		.action-buttons {
			display: flex;
			gap: 6px;
			align-items: center;
			flex-wrap: nowrap;
		}

		.action-buttons form {
			margin: 0;
		}

		/* ===== BUTTON STYLE (SOFT ADMIN) ===== */
		.btn {
			padding: 4px 10px;
			border-radius: 4px;
			font-size: 13px;
			text-decoration: none;
			border: none;
			cursor: pointer;
			font-weight: 500;
		}

		/* View */
		.btn-view {
			background: #4b5563;      /* abu gelap */
			color: #f9fafb;
		}
		.btn-view:hover {
			background: #374151;
		}

		/* Edit */
		.btn-edit {
			background: #2563eb;      /* biru tenang */
			color: #f9fafb;
		}
		.btn-edit:hover {
			background: #1d4ed8;
		}

		/* Delete */
		.btn-delete {
			background: #dc2626;      /* merah soft */
			color: #fef2f2;
		}
		.btn-delete:hover {
			background: #b91c1c;
		}
		
		/* ===== SORT BAR ===== */
		/* ===== SORT BAR (CLEAR UX) ===== */
		.sort-bar {
			display: flex;
			align-items: flex-end;
			gap: 12px;
			margin-bottom: 20px;
		}

		.sort-group {
			display: flex;
			flex-direction: column;
			gap: 4px;
		}

		.sort-group label {
			font-size: 13px;
			font-weight: 600;
			color: #4b5563;
		}

		.dark .sort-group label {
			color: #d1d5db;
		}

		.sort-group select {
			width: 220px;
			padding: 6px;
		}

		.btn-sort {
			background: #2563eb;
			color: #fff;
			padding: 7px 14px;
			border-radius: 6px;
			font-weight: 600;
		}


		/* ===== BUTTON (SOFT ADMIN) ===== */
		.btn {
			padding: 4px 10px;
			border-radius: 4px;
			font-size: 13px;
			border: none;
			cursor: pointer;
			font-weight: 500;
			text-decoration: none;
		}

		/* Primary */
		.btn-primary {
			background: #2563eb;
			color: #fff;
		}

		/* View */
		.btn-view {
			background: #4b5563;
			color: #f9fafb;
		}

		/* Edit */
		.btn-edit {
			background: #2563eb;
			color: #f9fafb;
		}

		/* Delete */
		.btn-delete {
			background: #dc2626;
			color: #fff;
		}

		/* Approve */
		.btn-approve {
			background: #16a34a;
			color: #fff;
			padding: 3px 8px;
		}

		/* ===== STATUS ===== */
		.status-box {
			display: flex;
			flex-direction: column;
			gap: 4px;
		}

		.status {
			font-weight: bold;
			font-size: 13px;
		}

		.status.approved {
			color: #16a34a;
		}

		.status.pending {
			color: #dc2626;
		}

		.link-detail {
			font-size: 13px;
			color: #2563eb;
			text-decoration: underline;
		}
		
		/* ===== FILTER BAR ===== */
		.filter-bar {
			display: flex;
			align-items: center;
			gap: 10px;
			margin-bottom: 20px;
			flex-wrap: wrap;
		}

		.filter-bar input,
		.filter-bar select {
			padding: 6px 8px;
			width: 220px;
		}

		/* ===== ITEM CARD ===== */
		.item-card {
			margin-bottom: 20px;
		}

		.item-image {
			max-width: 300px;
			display: block;
			margin-bottom: 10px;
		}

		.item-content {
			margin-bottom: 10px;
			color: inherit;
		}

		.item-video {
			width: 400px;
			height: 225px;
			border: none;
			margin-bottom: 10px;
		}

		/* ===== TEXT MUTED ===== */
		.text-muted {
			color: #6b7280;
		}
		.dark .text-muted {
			color: #9ca3af;
		}

		.comment-actions {
			display: flex;
			gap: 8px;
			align-items: center;
		}

		.comment-actions form {
			margin: 0;
			display: inline-flex;
		}

		.comment-actions a,
		.comment-actions button {
			font-size: 0.85rem;
		}



    </style>