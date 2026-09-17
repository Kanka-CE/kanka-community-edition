# Kanka Community Edition
*A community-maintained, self-hostable variant of the Kanka worldbuilding platform.*
If you want to self-host Kanka-CE, take a look at the [kanka-ce-container](https://github.com/kinnewig/kanka-ce-container).

Kanka CE is **not** affiliated with the official Kanka project.

> **Want to self-host Kanka CE?** You don't need anything from this repo directly —
> go to **[kanka-ce-deploy](https://github.com/Kanka-CE/kanka-ce-deploy)**, which has the full
> Quick Start guide, docker-compose file, and `.env` example.

## What is this?
This repository contains the **patched source code** of Kanka: a version of the
official codebase with a small set of changes applied to make self-hosting easier
(licensing checks, storage paths, config defaults, etc.).

To stay as compatible as possible with upstream Kanka, those changes are **not**
committed here by hand. Instead:

- The [`kanka-ce-deploy`](https://github.com/Kanka-CE/kanka-ce-deploy) repo holds the actual patch files and the
  automation that applies them.
- This repo is where the *result* of applying those patches to the latest upstream
  release is published and tagged, so anyone can browse or build from the exact
  source a given Kanka CE release runs.
- [`docker-kanka-ce`](https://github.com/Kanka-CE/docker-kanka-ce) then builds the container image from a tagged commit here.

Branches:
- `nightly`: The patched source, auto-generated from the latest upstream release.
- `upstream`: An untouched mirror of the official Kanka repo, kept only as a diffing baseline. Not meant to be run directly.

## Building / running from source
If you're modifying the application itself (not just deploying it), see the
[Development wiki page](https://github.com/Kanka-CE/kanka-community-edition/wiki/Development)
for running a local dev build.

If you just want to self-host Kanka CE, use
**[kanka-ce-container](https://github.com/Kanka-CE/kanka-ce-container)** instead — no need to touch this repo.

## Contributing
Kanka Community Edition only exists because of community contributions. If you've
found a bug in the application itself (as opposed to the deployment/patch tooling,
which lives in `kanka-ce-container`), this is the right place to open an issue.

See the [contributing guide](https://github.com/Kanka-CE/kanka-community-edition/blob/nightly/CONTRIBUTING.md)
and the [ToDo list](https://github.com/Kanka-CE/kanka-community-edition/blob/nightly/TODO.md).

No contribution is too small, even a typo fix helps.

## Related repositories

| Repo | What it's for |
|---|---|
| [kanka-ce-deploy](https://github.com/Kanka-CE/kanka-ce-deploy) | Self-hosting: docker-compose, `.env`, and the patches applied to this repo |
| [docker-kanka-ce](https://github.com/Kanka-CE/docker-kanka-ce) | The Dockerfile used to build the Kanka CE image from this source |

## License
This repository contains a modified version of the official Kanka source code, which is licensed under *Commons Clause License Condition v1.0*

- You may not remove or alter the Commons Clause.
- You may not sell this software or offer it as a paid service.
- See the included LICENSE file for full details.


## Notice
This repository contains modifications made by the community.
All original work is © the Kanka authors.

## ❤️ Support the Official Kanka Project
Kanka CE exists because the upstream project is amazing.
If you enjoy using Kanka or Kanka CE, please consider supporting the original creators:

💙 **Kanka Website:** https://kanka.io  
