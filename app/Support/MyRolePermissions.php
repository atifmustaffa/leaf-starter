<?php

namespace App\Support;

class MyRolePermissions
{
  private array $config;

  public function __construct(array $config)
  {
    $this->config = $config;
  }

  /**
   * Build final roles with resolved permissions
   */
  public function build(): array
  {
    $finalRoles = [];

    foreach ($this->config['roles'] as $role => $cfg) {
      $finalRoles[$role] = $this->resolvePermissions($role, $cfg);
    }

    return $finalRoles;
  }

  /**
   * Resolve permissions for a single role
   */
  private function resolvePermissions(string $role, array $cfg): array
  {
    // Admin gets all permissions automatically
    if ($role === 'admin') {
      return $this->getAllPermissions();
    }

    // Collect permissions from groups
    $permissions = $this->resolveGroups($cfg['groups'] ?? []);
    $permissions = array_merge($permissions, $cfg['permissions'] ?? []);

    return $this->normalizePermissions($permissions);
  }

  /**
   * Get all available permissions across all groups
   */
  private function getAllPermissions(): array
  {
    $all = [];

    foreach ($this->config['groups'] as $groupPerms) {
      $all = array_merge($all, $groupPerms);
    }

    return $this->normalizePermissions($all);
  }

  /**
   * Resolve permission groups into actual permissions
   */
  private function resolveGroups(array $groups): array
  {
    $permissions = [];

    foreach ($groups as $group) {
      if (!isset($this->config['groups'][$group])) {
        throw new \RuntimeException("Unknown permission group: {$group}");
      }

      $permissions = array_merge($permissions, $this->config['groups'][$group]);
    }

    return $permissions;
  }

  /**
   * Remove duplicates and sort permissions
   */
  private function normalizePermissions(array $permissions): array
  {
    $permissions = array_unique($permissions);
    sort($permissions);

    return array_values($permissions);
  }
}