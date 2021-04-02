# Tchurymail

## This is a Work In Progress!

## Introduction

Tchurymail is an open-source software to manage your business emails. Within the admin panel, you can create emails
template, and through APIs, you can send these emails, written in **MJML**.

## Installation

1. Set mail variables in .env
2. Run `php artisan migrate --seed`
3. Start the server

## Roadmap to v1.0

- [x] User management
- [x] Template management
- [x] Variables integration
- [x] Send email
- [x] Head tags
- [x] Duplicate template
- [x] Recover password
- [ ] Category of template
- [ ] Multiple email accounts
- [ ] Calendars invitation

### Next major releases

- [ ] Token permissions
- [ ] Visual builder

## Supported tags

### Head

- [x]  mj-attributes
- [ ]  mj-breakpoint
- [x]  mj-font
- [ ]  mj-html-attributes
- [x]  mj-preview
- [x]  mj-style
- [x]  mj-title

### Body

- [x]  Accordion
- [x]  Button
- [x]  Carousel
- [x]  Column
- [x]  Divider
- [ ]  Group
- [x]  Hero
- [x]  Image
- [ ]  Navbar
- [ ]  Raw
- [x]  Section
- [x]  Social
- [x]  Spacer
- [x]  Table
- [x]  Text
- [x]  Wrapper
