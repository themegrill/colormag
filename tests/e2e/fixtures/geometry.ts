import type { Locator } from '@playwright/test';

export type Box = { x: number; y: number; width: number; height: number };

/**
 * Plain geometry helpers for layout assertions — used instead of reading
 * `flex-direction`/CSS class names so specs describe what a visitor would
 * actually see (image above vs. beside content) and keep working if the
 * underlying CSS technique changes.
 */

export async function box(locator: Locator): Promise<Box> {
  const b = await locator.boundingBox();
  if (!b) {
    throw new Error('Element has no bounding box — is it visible/attached?');
  }
  return b;
}

/** True when `a` sits entirely above `b` (or vice versa), not side-by-side. */
export function isStackedVertically(a: Box, b: Box): boolean {
  return a.y + a.height <= b.y + 1 || b.y + b.height <= a.y + 1;
}

/** True when `a` and `b` occupy roughly the same vertical band. */
export function isSideBySide(a: Box, b: Box): boolean {
  const overlap = Math.min(a.y + a.height, b.y + b.height) - Math.max(a.y, b.y);
  return overlap > Math.min(a.height, b.height) * 0.5;
}
