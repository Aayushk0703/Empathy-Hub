const RAW_API_BASE = import.meta.env.VITE_API_BASE_URL?.trim();

export const API_BASE_URL = RAW_API_BASE
  ? RAW_API_BASE.replace(/\/+$/, "")
  : "/api";

const TOKEN_KEY = "empathyhub_auth_token";

export type ApiError = {
  message: string;
  errors?: Record<string, string[]>;
};

export function getAuthToken() {
  return window.localStorage.getItem(TOKEN_KEY);
}

export function setAuthToken(token: string) {
  window.localStorage.setItem(TOKEN_KEY, token);
}

export function clearAuthToken() {
  window.localStorage.removeItem(TOKEN_KEY);
}

export async function apiRequest<T>(path: string, init: RequestInit = {}): Promise<T> {
  const token = getAuthToken();
  const headers = new Headers(init.headers ?? {});

  if (!headers.has("Accept")) {
    headers.set("Accept", "application/json");
  }

  if (init.body && !headers.has("Content-Type")) {
    headers.set("Content-Type", "application/json");
  }

  if (token && !headers.has("Authorization")) {
    headers.set("Authorization", `Bearer ${token}`);
  }

  const response = await fetch(`${API_BASE_URL}${path}`, {
    ...init,
    headers,
  });

  const contentType = response.headers.get("content-type") ?? "";
  const payload = contentType.includes("application/json")
    ? await response.json()
    : await response.text();

  if (!response.ok) {
    const validationErrors =
      typeof payload === "object" && payload !== null && "errors" in payload
        ? (payload.errors as Record<string, string[]>)
        : undefined;

    const firstValidationMessage = validationErrors
      ? Object.values(validationErrors).flat().find(Boolean)
      : undefined;

    const message =
      firstValidationMessage ||
      (typeof payload === "object" && payload !== null && "message" in payload
        ? String(payload.message)
        : "Something went wrong. Please try again.");

    throw {
      message,
      errors: validationErrors,
    } satisfies ApiError;
  }

  return payload as T;
}
